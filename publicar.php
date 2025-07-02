<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publicar | Universo Animal</title>
  <style>
    /* Estilos generales */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
      color: #333;
      line-height: 1.6;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }
    
    /* Contenedor principal */
    h1 {
      color: #2c3e50;
      margin: 30px 0;
      text-align: center;
      font-size: 2.2rem;
      position: relative;
      padding-bottom: 10px;
    }
    
    h1::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 4px;
      background-color: #3498db;
      border-radius: 2px;
    }
    
    /* Formulario */
    form {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 100%;
      max-width: 600px;
      margin-bottom: 30px;
    }
    
    /* Campos del formulario */
    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    
    input[type="text"] {
      height: 50px;
    }
    
    textarea {
      min-height: 150px;
      resize: vertical;
    }
    
    input[type="file"] {
      padding: 10px;
      background-color: #f8f9fa;
    }
    
    input[type="text"]:focus,
    textarea:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }
    
    /* Placeholders */
    ::placeholder {
      color: #95a5a6;
      opacity: 1;
    }
    
    /* Botón de enviar */
    button[type="submit"] {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 14px 20px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 100%;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    button[type="submit"]:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
    }
    
    button[type="submit"]:active {
      transform: translateY(0);
    }
    
    /* Diseño responsive */
    @media (max-width: 768px) {
      body {
        padding: 15px;
      }
      
      h1 {
        font-size: 1.8rem;
        margin: 20px 0;
      }
      
      form {
        padding: 20px;
      }
    }
    
    @media (max-width: 480px) {
      h1 {
        font-size: 1.5rem;
      }
      
      input[type="text"],
      textarea,
      input[type="file"] {
        padding: 10px 12px;
        margin-bottom: 15px;
      }
      
      button[type="submit"] {
        padding: 12px;
      }
    }
  </style>
</head>
<body>

  <h1>Publicar Mascota Perdida</h1>
  <form action="subir.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nombre" placeholder="Nombre de la mascota" required>
    <textarea name="descripcion" placeholder="Descripción de la mascota" required></textarea>
    <input type="file" name="foto" accept="image/*" required>
    <button type="submit">Publicar</button>
  </form>

</body>
</html>