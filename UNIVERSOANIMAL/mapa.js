// mapa.js
// Recomendado: abrir consola para ver logs (F12)

const OVERPASS_URL = "https://overpass-api.de/api/interpreter";
// Si tenés problemas CORS o querés cache, usa overpass_proxy.php y cambial la URL

let map = L.map('map', { preferCanvas: true }).setView([-34.6037, -58.3816], 13);

// Capa OSM básica (gratuita)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Marker para la posición del usuario
let userMarker = null;
let userAccuracyCircle = null;

// Grupo para marcadores de lugares (permite limpiar fácilmente)
let lugaresLayer = L.layerGroup().addTo(map);

// Opcional: agrupar muchos marcadores para rendimiento y UX
let useCluster = true;
let clusterGroup = useCluster ? L.markerClusterGroup() : null;
if (useCluster) map.addLayer(clusterGroup);

// Filtros DOM
const chkVet = document.getElementById('filtro-vet');
const chkPet = document.getElementById('filtro-pet');
const chkRef = document.getElementById('filtro-refugio');
const btnRecenter = document.getElementById('btn-recenter');

btnRecenter.addEventListener('click', () => {
  if (lastUserPos) map.setView(lastUserPos, 15);
});

// Mantener última posición
let lastUserPos = null;
let watchId = null;

// Opciones para watchPosition
const geoOptions = {
  enableHighAccuracy: true,
  maximumAge: 10000, // ms
  timeout: 10000
};

// Lanzar geolocalización en tiempo real
if ('geolocation' in navigator) {
  watchId = navigator.geolocation.watchPosition(onLocation, onLocationError, geoOptions);
} else {
  alert('Tu navegador no soporta geolocalización.');
}

function onLocation(position) {
  const lat = position.coords.latitude;
  const lon = position.coords.longitude;
  const accuracy = position.coords.accuracy; // en metros
  lastUserPos = [lat, lon];

  // Crear o mover marcador usuario
  if (!userMarker) {
    userMarker = L.marker([lat, lon], { title: 'Tu ubicación' })
      .bindPopup('Tú estás aquí')
      .addTo(map);
    userAccuracyCircle = L.circle([lat, lon], { radius: accuracy || 50 }).addTo(map);
    map.setView([lat, lon], 15);
  } else {
    userMarker.setLatLng([lat, lon]);
    userAccuracyCircle.setLatLng([lat, lon]);
    userAccuracyCircle.setRadius(accuracy || 50);
  }

  // Ejecutar búsqueda cada vez que se actualiza la ubicación
  // Si querés reducir llamadas, podés espaciar con timestamp
  buscarLugaresProximos(lat, lon);
}

function onLocationError(err) {
  console.warn('Error geolocalización:', err.message);
  // Fallback: podés pedir al usuario que ingrese su ubicación manualmente
}

// --- Overpass query builder ---
// Busca nodos y ways con tags que nos interesan en un radio (metros)
function buildOverpassQuery(lat, lon, radius = 3000) {
  // Filas: veterinarias, pet shops, animal_shelter
  // Consultamos nodes + ways + relations para mayor cobertura.
  return `
    [out:json][timeout:25];
    (
      node["amenity"="veterinary"](around:${radius},${lat},${lon});
      way["amenity"="veterinary"](around:${radius},${lat},${lon});
      relation["amenity"="veterinary"](around:${radius},${lat},${lon});

      node["shop"="pet"](around:${radius},${lat},${lon});
      way["shop"="pet"](around:${radius},${lat},${lon});
      relation["shop"="pet"](around:${radius},${lat},${lon});

      node["animal_shelter"](around:${radius},${lat},${lon});
      way["animal_shelter"](around:${radius},${lat},${lon});
      relation["animal_shelter"](around:${radius},${lat},${lon});
    );
    out center;`; // 'center' para ways/relations -> devuelve lat/lon medio
}

// Control simple para no duplicar queries si se llaman rápido
let lastQueryKey = null;
let lastQueryTime = 0;

function buscarLugaresProximos(lat, lon) {
  const radius = 3000; // metros
  const key = `${Math.round(lat*10000)}_${Math.round(lon*10000)}_${radius}`;

  // evitar hacer la misma query si se llamó hace <10s
  const ahora = Date.now();
  if (key === lastQueryKey && (ahora - lastQueryTime) < 10000) return;
  lastQueryKey = key;
  lastQueryTime = ahora;

  const query = buildOverpassQuery(lat, lon, radius);

  // limpiar markers previos
  lugaresLayer.clearLayers();
  if (useCluster) clusterGroup.clearLayers();

  // POST a Overpass (puede tardar un poco)
  fetch(OVERPASS_URL, {
    method: 'POST',
    body: query,
    headers: {
      'Content-Type': 'text/plain' // Overpass acepta text/plain
    }
  })
  .then(res => {
    if (!res.ok) throw new Error('Overpass no respondió ok: ' + res.status);
    return res.json();
  })
  .then(json => {
    if (!json.elements) return;
    json.elements.forEach(el => {
      // obtener lat/lon (nodes tienen lat/lon; ways/relations usan .center)
      const latEl = el.lat || (el.center && el.center.lat);
      const lonEl = el.lon || (el.center && el.center.lon);
      if (!latEl || !lonEl) return;

      // determinar tipo
      const tags = el.tags || {};
      const tipo = tags.amenity === 'veterinary' ? 'veterinaria' :
                   tags.shop === 'pet' ? 'petshop' :
                   tags.animal_shelter ? 'refugio' : 'otro';

      // aplicar filtros (checkboxes)
      if (tipo === 'veterinaria' && !chkVet.checked) return;
      if (tipo === 'petshop' && !chkPet.checked) return;
      if (tipo === 'refugio' && !chkRef.checked) return;

      // popup con info útil
      const nombre = tags.name || 'Sin nombre';
      const direccion = tags['addr:street'] ? `${tags['addr:street'] || ''} ${tags['addr:housenumber'] || ''}`.trim() : '';
      const tel = tags.phone || tags['contact:phone'] || '';
      const web = tags.website || tags.url || '';
      const popupHtml = `
        <strong>${escapeHtml(nombre)}</strong><br>
        Tipo: ${tipo}<br>
        ${direccion ? `Dirección: ${escapeHtml(direccion)}<br>` : ''}
        ${tel ? `Tel: ${escapeHtml(tel)}<br>` : ''}
        ${web ? `<a href="${escapeAttr(web)}" target="_blank">Sitio</a><br>` : ''}
      `;

      const marker = L.marker([latEl, lonEl]);
      marker.bindPopup(popupHtml);

      if (useCluster) clusterGroup.addLayer(marker);
      else lugaresLayer.addLayer(marker);
    });
  })
  .catch(err => {
    console.error('Error Overpass:', err);
    // Si Overpass falla, podés notificar al usuario o intentar proxy
  });
}

// Helpers para seguridad básica en popups
function escapeHtml(s){
  if(!s) return '';
  return s.replace(/[&<>"']/g, function(m){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m]; });
}
function escapeAttr(s){
  if(!s) return '';
  return s.replace(/"/g, '%22');
}

// Recalcular cuando cambian filtros
[chkVet, chkPet, chkRef].forEach(chk => {
  chk.addEventListener('change', () => {
    if (!lastUserPos) return;
    buscarLugaresProximos(lastUserPos[0], lastUserPos[1]);
  });
});
