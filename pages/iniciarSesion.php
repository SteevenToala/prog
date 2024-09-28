<?php
include '../util/conexion.php';

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']);  // Borrar el error después de mostrarlo

session_start();

include '../util/verificadorSesion.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/background.css">
  <style>
    .container-login {
      background-color: white;
      padding: 50px;
      border-radius: 20px;

    }
  </style>
</head>
<body>
  <!-- Menú de Navegación -->
  <?php
  include '../util/menu.php';
  ?>

  <div class="container mt-5 container-login">
    <h2 class="mb-4 text-center">Inicio de Sesión</h2>

    <!-- Div para mostrar alertas de error -->
    <div id="error" class="alert alert-danger" style="display:none;" role="alert"></div>

    <form id="loginForm" class="w-50 mx-auto">
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS (Opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/iniciarSesion.js"></script>
</body>

</html>