<?php
session_start();

// Si no existe el rol, definimos un valor por defecto
if (!isset($_SESSION['usuario_rol'])) {
    $_SESSION['usuario_rol'] = 'usuario'; // por ejemplo
}

// Definimos si el usuario actual es administrador
$isAdmin = ($_SESSION['usuario_rol'] === 'admin');


if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}
// 🔹 Usar el rol correcto (de la sesión real)
$rol = $_SESSION['rol'] ?? 'usuario';
$isAdmin = ($rol === 'admin');
?>
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="estilos/edad.css?v=<?php echo time(); ?>"/>
    <link rel="stylesheet" href="estilos/diseño.css">
    <title>Edades | Universo animal</title>
  </head>

  <body>
    <div class="menu">
      <div class="logo-container">
            <a href="/UNIVERSOANIMAL/pagina.php"><img src="img/logo.png"></a>
      </div>
      <div class="logo">Universo Animal</div>
      <button class="hamburger" aria-label="Abrir menú">&#9776;</button>

       <nav class="navbar">
  <div class="nav-container">

    <button class="menu-toggle" id="menuToggle">
      ☰
    </button>

    <ul class="nav-links" id="navMenu">
      <li class="dropdown">
        <a href="#">Cuidados</a>
        <ul class="submenu">
          <li><a href="desparacitacion.php">Desparasitación</a></li>
          <li><a href="pulgagarra.php">Pulgas y garrapatas</a></li>
          <li><a href="baños.php">Baños</a></li>
          <li><a href="Edades.php">Edades</a></li>
        </ul>
      </li>

      <li><a href="callamulloproyecto/index.php">Campañas</a></li>

      <?php if ($isAdmin): ?>
      <li class="dropdown">
        <a href="#">Admin</a>
        <ul class="submenu">
          <li><a href="Registro/crear_campañias.php">+ Crear campaña</a></li>
          <li><a href="tabla.php">- Eliminar Usuario</a></li>
        </ul>
      </li>
      <?php endif; ?>

      <li><a href="redsocial/ver.php">Perdidos</a></li>
      <li><a href="contacto.php">Contacto</a></li>
      <li><a href="Registro/logout.php" class="logout">Cerrar Sesión</a></li>
    </ul>
  </div>
</nav>

    </div>
    <header>
      <div class="section__container header__container">
        <div class="header__content">
          <h4>¡Bienvenido!</h4>
          <h1>Etapas<br /><span>De Los Animales</span></h1>
          <h2>Nosotros también los amamos :)</h2>
          <p>
            En los perros, la llamada “fase de cachorro” puede durar entre 12 y 24 meses, en función de la raza.
            Es una etapa de grandes cambios físicos y comportamentales, especialmente durante los primeros meses.
          </p>
        </div>
        <div class="header__image">
          <img src="img/header2.png" alt="header-bg" class="header__image-bg" />
          <img src="img/perropng.png" alt="header" />
        </div>
      </div>
      <div class="header__bottom"></div>
    </header>

    <section class="client">
      <div class="section__container">
        <h2 class="section__header">¿En qué etapa se encuentra tu perro?</h2>
        <div class="client__card">
          <details>
            <summary>Cachorro</summary>
            <p>
              Esta etapa va desde el nacimiento hasta los tres meses. El cachorro crece muy rápido y empieza a socializar con su madre, hermanos y personas. Es un momento clave para su desarrollo físico y emocional, donde se establecen las bases para su conducta futura.
            </p>
          </details>

          <details>
            <summary>Juventud</summary>
            <p>
              Comienza alrededor de las 12 semanas y se extiende hasta que el perro alcanza la madurez sexual. El tiempo para alcanzar esta madurez depende de la raza, siendo más temprano en perros pequeños y más tardío en razas grandes. En esta fase, el perro experimenta cambios hormonales que pueden provocar conductas territoriales y agresividad. Es fundamental la educación para guiar su comportamiento.
            </p>
          </details>

          <details>
            <summary>Adultez</summary>
            <p>
              En esta etapa el perro ya está físicamente desarrollado, aunque puede tardar en madurar socialmente. El comportamiento se vuelve más estable y equilibrado, con niveles de energía adecuados. Es importante mantener una rutina de ejercicio, alimentación balanceada y cuidados veterinarios para preservar su salud.
            </p>
          </details>

          <details>
            <summary>Vejez</summary>
            <p>
              Varía según el tamaño y la raza, siendo más temprano en perros grandes y más tardío en perros pequeños. El perro disminuye su actividad física y puede presentar problemas de salud propios del envejecimiento, como dificultades articulares. El comportamiento cambia, mostrando mayor dependencia o menor tolerancia a cambios. Los cuidados se enfocan en asegurar su bienestar y calidad de vida.
            </p>
          </details>
        </div>
      </div>
    </section>

    <section class="client">
      <div class="section__container">
        <div class="overlay">
          <h2 class="section__header">¿En qué etapa se encuentra tu gato?</h2>
        </div>
        <div class="client__card">
          <details>
            <summary>Cachorro: 0-6 meses</summary>
            <p>
              Es una fase de crecimiento importante en la vida del gato, que cambia rápidamente de una semana a otra.
              Mientras sea cachorro, el gato será travieso y juguetón independientemente de la raza, por lo que no se puede determinar si será tranquilo o salvaje cuando sea adulto. Comienza a educar al gato a partir de este momento y acostúmbrale a que le examinen partes del cuerpo, como dientes, orejas y garras. De esta manera, reducirás los problemas relacionados con esto en el futuro.
              <br />
              En esta fase, también se puede esterilizar al gato, concretamente a partir de los cuatro meses.
            </p>
          </details>

          <details>
            <summary>Joven: 7 meses-2 años</summary>
            <p>
              Tu gato ya es joven, curioso, juguetón y fuerte. Esta fase de la vida también implica que alcanza la madurez sexual; de hecho madura de forma general, tanto física como emocionalmente. Si no le has esterilizado, puede que empiece a comportarse de manera no deseada a partir de ahora.
              <br />
              Como al gato joven le encanta explorar su entorno, las cuestiones de salud que pueda padecer suelen derivarse de infecciones u otros problemas causados por la caza y las peleas. También recibirá su primera vacuna de refuerzo, que le protegerá de algunas de las enfermedades infecciosas más comunes.
            </p>
          </details>

          <details>
            <summary>Adulto: 3-6 años</summary>
            <p>
              Tu gato ya es un adulto. Este período suele ser bastante tranquilo si está sano. Comprueba su estado de salud mediante controles periódicos de los dientes, el peso y el comportamiento en general. Los problemas dentales son comunes en muchos gatos adultos y pueden provocar dolor o caída de los dientes.
            </p>
          </details>

          <details>
            <summary>Maduro: 7-10 años</summary>
            <p>
              Como ya se ha dicho, la edad de un gato no siempre coincide con su aspecto o comportamiento. Cuando alcanza la madurez, a menudo sigue pareciendo joven y siendo tan juguetón como antes, pero el riesgo de padecer algunos problemas típicos de los gatos mayores aumenta. Entre ellos, se encuentran la diabetes, la hipertensión, el cáncer o la obesidad. Presta especial atención a tu gato para detectar cambios en su conducta o estado de salud.
            </p>
          </details>

          <details>
            <summary>Senior: 11-14 años</summary>
            <p>
              ¡Enhorabuena! Tu gato y tú os conocéis desde hace mucho tiempo. En este momento, muchos gatos optan por calmarse y apreciar sus rutinas. Cuando alcanzan esta etapa de la vida, es más probable que desarrollen algunas enfermedades, como demencia, problemas de la piel, cáncer, diabetes o artritis. Aun así, muchas de ellas pueden tratarse, por lo que no debes ignorarlas simplemente porque tu gato sea mayor. La obesidad también suele alcanzar su punto máximo en esta etapa (o un poco antes), de modo que puedes introducir algunos cambios en la alimentación. Comprueba la condición corporal y el peso de tu gato mediante controles periódicos, ya que pueden producirse cambios que no hayas detectado. Presta atención también a su estado de salud general.
            </p>
          </details>

          <details>
            <summary>Anciano: 15 años o más</summary>
            <p>
              A medida que el gato envejece, necesita una atención especial. Obviamente, existen aún más probabilidades de que las enfermedades que ya son comunes durante la fase senior se desarrollen ahora. Por ello, debes realizar controles y exámenes médicos periódicos. Muchos de los problemas y enfermedades de los gatos ancianos se pueden tratar con éxito, de modo que pueden tener una buena calidad de vida.
            </p>
          </details>
        </div>
      </div>
    </section>

   
      
        <div class="contenedor-nosotros ">
        
            <p class="bienvenida">Vacunas!</p>
            <h1>Perros</h1>
            <p>En la Argentina, la vacuna contra la rabia es obligatoria dentro del calendario. Se trata de una zoonosis, una enfermedad infecciosa que puede ser trasmitida naturalmente desde los animales a las personas, aunque cada vez es menos común.<br>
              También es obligatorio aplicarle al perro las vacunas que lo protegen contra el virus del moquillo canino y parvovirus.<br>
              Respecto de las opcionales, se encuentran aquellas dosis que protegen al animal frente a leptospirosis, leishmaniosis, parainfluenza, bordetella, Hepatitis infecciosa, enfermedad de Lyme y coronavirus.<br>
            </p>

            <p class="calen">Calendario para vacunas de perros</p>
            <li>A las 6 semanas de vida: se aplica la primovacunación o primera vacuna polivalente (séxtuple).</li>
             <li>A las 8 semanas de vida: segunda dosis de polivalente, que combate el adenovirus, el moquillo, la parainfluenza y el parvovirus.</li>
              <li>A las 12 semanas de vida: refuerzo de la polivalente.</li>
               <li>A las 16 semanas de vida: contra la rabia.</li>
                <li>Al año: refuerzo de la polivalente y de la vacuna contra la rabia.</li>
            <h1>Gatos</h1>
            <p>Los gatos deben recibir su primera vacuna a las 8 semanas de vida. Se trata de la triple felina, que protege contra la rinotraqueitis viral felina, el calicivirus felino y la panceleucopenia felina (moquillo), enfermedades que implican un riesgo alto de mortalidad. Además, es necesario aplicar un refuerzo a los 3 meses de vida.<br>
              Al igual que en el caso de los perros, es obligatoria la vacuna contra la rabia. La primera inoculación es a los 4 meses de vida, mientras que luego se debe repetir una vez por año.<br>
              Además se recomienda la vacuna contra la leucemia felina se administra idealmente a partir de las 8 semanas de edad, con un refuerzo a las 3-4 semanas de la primera dosis. Se recomienda una revacunación anual, especialmente para gatos con riesgo de exposición. Antes de vacunar, es crucial realizar una prueba para determinar si el gato es positivo o negativo a la enfermedad, ya que solo se debe vacunar a los gatos negativos.</p>
          </div>
          
    <div class="footerContainer">
        <div class="logos">
            <li><ion-icon name="logo-instagram"></ion-icon></li>
            <li><ion-icon name="logo-facebook"></ion-icon></li>
            <li><ion-icon name="logo-twitter"></ion-icon></li>
        </div>
        <div class="footerBotton">
            <p>Copyright &copy;2025 | Derechos reservados a Universo Animal</p>
        </div>

        <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js "></script> 
        <script  nomodule  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js "></script>
  </body>
</html>
