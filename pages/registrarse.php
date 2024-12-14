<?php
session_start();
include '../util/verificadorSesion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/background.css">
  <style>
    .container-registro {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      margin-top: 50px;
    }

    h2 {
      color: #0072ff;
      font-weight: bold;
      margin-bottom: 30px;
    }

    .form-control,
    .form-select {
      border-radius: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
      background-color: #0072ff;
      border: none;
      border-radius: 25px;
      padding: 12px;
      font-size: 18px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
      background-color: #005bb5;
      transform: translateY(-2px);
    }

    
    .footer {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <!-- Menú de navegación -->
  <?php include '../util/menu.php'; ?>

  <!-- Contenedor del formulario de registro -->
  <div class="container d-flex justify-content-center align-items-center">
    <div class="container-registro">
      <h2 class="text-center">Registro de Usuario</h2>
      
      <!-- Alerta de notificación -->
      <div id="alerta" class="alert alert-danger" style="display:none;" role="alert"></div>

      <!-- Formulario de registro -->
      <form id="registroForm">
        <div class="mb-4">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
        </div>

        <div class="mb-4">
          <label for="email" class="form-label">Email:</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu email" required>
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Contraseña:</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
        </div>
       
        <div class="mb-4">
          <label for="passwordConfirm" class="form-label">Contraseña:</label>
          <input type="password" id="passwordConfirm" name="passwordConfirm" class="form-control" placeholder="Confirma tu contraseña" required>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
      </form>

      <!-- Pie de página con enlace para iniciar sesión -->
      <div class="footer mt-4">
        ¿Ya tienes una cuenta? <a href="iniciarSesion.php">Inicia sesión aquí</a>
      </div>
    </div>
  </div>

  <?php 
  include '../util/codigomodal.html';
  include '../util/modalCRegistrar.html'
  ?>

  <!-- Scripts de Bootstrap y jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/registrarse.js"></script>
</body>

</html>
