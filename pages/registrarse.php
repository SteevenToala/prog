<?php
session_start();
include '../util/verificadorSesion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/background.css">
  <style>
    .container-registro{
      background-color: white;      
      padding: 50px;
      border-radius: 20px;
      
    }
  </style>
</head>
<body>
  <?php
  include '../util/menu.php';
  ?>



<div class="container mt-5 container-registro">
    <h2 class="mb-4 text-center">Registro de Usuario</h2>

    <!-- Div para mostrar alertas -->
    <div id="alerta" class="alert d-none" role="alert"></div>

    <form id="registroForm" class="w-50 mx-auto">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
      </div>

      <div class="mb-3">
        <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
        <select id="tipo_usuario" name="tipo_usuario" class="form-select" required>
          <option value="administrador">Administrador</option>
          <option value="empleado">Empleado</option>
          <option value="usuario_normal">Usuario Normal</option>
        </select>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Registrar</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS (Opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript para manejar el envío de datos por AJAX -->
  <script src="../js/registrarse.js"></script>
  
</body>
</html>