<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/diseño.css">
  <title>Publicar | Universo Animal</title>
  
  <style>
    .formuulario {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    form {
      background-color: #fff;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      padding: 35px;
      width: 100%;
      max-width: 600px;
      margin-bottom: 30px;
      transition: box-shadow 0.3s ease;
      background-image: url(https://i.pinimg.com/736x/d4/c9/20/d4c920c9f72ed2a039cc97a96887e39d.jpg);
    }

    form:hover {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 14px 18px;
      margin-bottom: 20px;
      border: 1px solid #d0d0d0;
      border-radius: 12px;
      font-size: 1rem;
      transition: border 0.3s, box-shadow 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus {
      outline: none;
      border-color:rgb(224, 103, 248);
      
    }

    textarea {
      min-height: 150px;
      resize: vertical;
    }

    input[type="file"] {
      background-color: #f0f0f0;
      cursor: pointer;
    }

    ::placeholder {
      color: #a0a0a0;
    }

    button[type="submit"] {
      background: linear-gradient(135deg,rgb(201, 143, 235),rgb(211, 121, 219));
      color: white;
      border: none;
      padding: 14px 25px;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: bold;
      width: 100%;
      cursor: pointer;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: 0.3s ease, transform 0.2s ease;
    }

    button[type="submit"]:hover {
      background: linear-gradient(135deg,rgb(172, 92, 226),rgb(202, 113, 243));
      transform: translateY(-2px);
    }

    button[type="submit"]:active {
      transform: translateY(0);
    }

    @media (max-width: 600px) {
      form {
        padding: 25px;
      }

      h1 {
        font-size: 1.8rem;
      }
    }
  </style>

</head>
<body>

<header class="Encabezado">
        <div class="logo-container">
            <a href="/UNIVERSOANIMAL/pagina.php"><img src="../img/logo.png"></a>
        </div>
        <nav class="menu">
            <a href="/UNIVERSOANIMAL/callamulloproyecto/index.php" class="styled-link">Campañas</a>
            <a href="redsocial/ver.php" class="styled-link">Feed</a>
            <div class="dropdown">
            <a href="" class="styled-link">Datos</a>
            <div class="submenu">
               <a href="#">Desparacitación</a>
               <a href="#">Pulgas y garrapatas</a>
               <a href="datos.php">Baños</a>
               <a href="#">Edades</a>
            </div>
            </div>
            <a href="contacto.php" class="styled-link">Contacto</a>
            <button class="boton"><a href="../Registro/logout.php">Cerrar sesión</a></button>
        </nav>
        <button class="menu-hamburguesa" aria-label="Menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

  <h1 class="titu">Publicar a tu mascota perdida</h1>

  <div class="formuulario">
    <form action="subir.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nombre" placeholder="Nombre de la mascota" required>
    <textarea name="descripcion" placeholder="Descripción de la mascota" required></textarea>
    <input type="file" name="foto" accept="image/*" required>
    <button type="submit">Publicar</button>
  </form>
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
  <script src="/UNIVERSOANIMAL/prueba.js"></script>

</body>
</html>
