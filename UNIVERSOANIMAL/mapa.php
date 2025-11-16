<?php
// mapa.php
// Si querés validar sesión: require_once '../includes/auth.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Mapa - Universo Animal</title>

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Opcional: MarkerCluster CSS si lo usás luego -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

  <link rel="stylesheet" href="estilos/mapa.css" />
</head>
<body>
  <header class="topbar">
    <h1>Mapa — Universo Animal</h1>
    <div class="controls">
      <label><input type="checkbox" id="filtro-vet" checked> Veterinarias</label>
      <label><input type="checkbox" id="filtro-pet" checked> Pet shops</label>
      <label><input type="checkbox" id="filtro-refugio" checked> Refugios</label>
      <button id="btn-recenter">Seguir ubicación</button>
    </div>
  </header>

  <div id="map"></div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- MarkerCluster (opcional, recomendado si hay muchos marcadores) -->
  <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

  <script src="mapa.js"></script>
</body>
</html>
