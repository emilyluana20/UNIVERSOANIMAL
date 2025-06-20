<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Universo Animal</title>
  <link rel="stylesheet" href="Estilo/estilo.css">
</head>
<body>

  <header class="header">
  <div class="logo">Universo Animal</div>

  <button class="menu-toggle" aria-label="Abrir menú">
    ☰
  </button>

  <nav class="nav">
    <a href="#cuidados">Cuidados</a>
    <a href="#campanias">Campañas</a>
    <a href="#perdidos">Perdidos</a>
    <a href="#reencuentros">Reencuentros</a>
    <a href="#contacto">Contacto</a>
   <a href="logout.php" class="cerrar-sesion">Cerrar sesión</a>
  </nav>
  <p>Hola, <?php echo $_SESSION['usuario']; ?> 👋</p>
</header>

  <section class="bienvenida">
  <div class="contenido-bienvenida">
    <div class="texto-bienvenida">
      <h1>Bienvenido a<br>Universo Animal</h1>
      <p>Hola, <?php echo $_SESSION['usuario']; ?> 👋</p>
      <p>El mejor cuidado para tu mascota</p>
      <button>Conocé más</button>
    </div>
    <div class="imagen-bienvenida">
      <img src="imagenes/Foto inicial.png" class="img" alt="Foto de bienvenida">
    </div>
  </div>
</section>
  <section class="cuidados">
    <h2>Cuida a tu mascota como se merece</h2>
    <div class="items-cuidados">
      <div class="item">
        <img src="imagenes/Desparacitación.jpg" alt="Baños">
        <p>Desparacitación</p>
      </div>
      <div class="item">
        <img src="imagenes/Calendario-vacunas.webp" alt="Corte de uñas">
        <p>Vacunas</p>
      </div>
      <div class="item">
        <img src="imagenes/Pipetas.jpg" alt="Cantidad de comida">
        <p>Pipetas y talcos</p>
      </div>
      <div class="item">
        <img src="imagenes/Parasitos.jpg" alt="Vacunas">
        <p>Parasitos</p>
      </div>
      <div class="item">
        <img src="imagenes/Baños.webp" alt="Juguetes">
        <p>Baños</p>
      </div>
  
    </div>
  </section>
<!-- Buscador de campañas -->
<section class="campanias">
      <h2>Campañas</h2>
  <div class="tarjetas-campanias">
    <div class="card">
      <img src="imagenes/Vacunación1.jpg" alt="Campaña">
      <p><strong>Monte Grande</strong><br>de 09:00 a 13:30<br>Públicas</p>
      <div class="card">
      <div class="mapita">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2685.814412134237!2d-63.5846833!3d-35.2408674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95c4f5be4a3f815d%3A0x8d5443e683d59c53!2sPOLIDEPORTIVO%20MUNICIPAL%20Intendente%20Alvear!5e1!3m2!1ses-419!2sar!4v1749237373719!5m2!1ses-419!2sar" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <p><strong>Polideportivo Alvear</strong><br></p>
    </div>
    </div>

    <div class="card">
      <img src="imagenes/Vacunación2.jpg" alt="Campaña">
      <p><strong>Barrio Ledesma</strong><br>de 08:00 a 12:30<br>Privadas</p>
      <div class="card">
      <div class="mapita">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2719.5798574462906!2d-58.93444702496602!3d-34.20807733671048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bb71002bba6cbb%3A0x3837d792753b7071!2sBARRIO%20LAS%20CAMPANAS!5e1!3m2!1ses-419!2sar!4v1749238402718!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <p><strong>Barrio Las Campanas</strong><br></p>
    </div>
    </div>

    <div class="card">
      <img src="imagenes/Vacunación3.jpg" alt="Campaña">
      <p><strong>Villa Dominico</strong><br>de 09:00 a 13:30<br>Privadas</p>
      <div class="card">
      <div class="mapita">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21629.44319282979!2d-58.356375339427586!3d-34.697746132859514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a332f18a3b7253%3A0x82c99650b5f6fa8c!2sB1874%20Villa%20Dominico%2C%20Provincia%20de%20Buenos%20Aires!5e1!3m2!1ses-419!2sar!4v1749238460918!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <p><strong>Villa Dominico</strong><br></p>
    </div>
    </div>
    
    <div class="card">
      <img src="imagenes/Vacunación4.jpg" alt="Campaña">
      <p><strong>Villa Dominico</strong><br>de 09:00 a 13:30<br>Públicas</p>
      <div class="card">
      <div class="mapita">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21629.44319282979!2d-58.356375339427586!3d-34.697746132859514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a332f18a3b7253%3A0x82c99650b5f6fa8c!2sB1874%20Villa%20Dominico%2C%20Provincia%20de%20Buenos%20Aires!5e1!3m2!1ses-419!2sar!4v1749238460918!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <p><strong>Villa Dominico</strong><br></p>
    </div>
      </div>
  </div>
</section>

<!-- Mascotas perdidas -->
<section class="perdidos">
  <h2>Ayudanos a que vuelva a su hogar</h2>
  <div class="tarjetas-perdidos">
    <div class="card-perdido">
      <img src="imagenes/Perrito1.webp" alt="Perro perdido">
      <p>Se llama fatiga. Se perdió en Sarmiento al 600. Es muy mimoso y amigable. Tiene collar azul. Tel: 1132236389</p>
    </div>
    <div class="card-perdido">
      <img src="imagenes/Perrito2.jpg" alt="Perro perdido">
      <p>Se llama Terry. Lo encontre en Liñan 1940. Es muy mimoso y amigable. Tiene collar Negro. Tel: 1133405781</p>
    </div>
    <div class="card-perdido">
      <img src="imagenes/Gatito1.jpg" alt="Perro perdido">
      <p>Se llama Mishu. Se perdió en Lavalle 1500. Tiene collar rosa. Tel: 1132689324</p>
    </div>
  </div>
  <button class="boton-publicar">Ver más / Publicar</button>
</section>

<h2>Reencuentros felices</h2>
<div class="reencuentros-galeria">
  <div class="card-reencuentro">
    <img src="imagenes/Reencuentro1.jpeg" alt="Reencuentro 1">
    <p>¡Volvió a casa después de 2 semanas!</p>
  </div>
  <div class="card-reencuentro">
    <img src="imagenes/Reencuentro2.jpeg" alt="Reencuentro 2">
    <p>Reencuentro con su familia humana 💜</p>
  </div>
  <div class="card-reencuentro">
    <img src="imagenes/Reencuentro3.jpeg" alt="Reencuentro 3">
    <p>Gracias a la difusión, fue encontrado</p>
  </div>
</div>
<script>
  const menuToggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.nav');

  menuToggle.addEventListener('click', () => {
    nav.classList.toggle('active');
  });
</script>

</body>
</html>
