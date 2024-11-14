<?php
include '../util/conexion.php';

$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']);

session_start();
include '../util/verificadorSesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/background.css">
  <style>
    .container-login {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      color: #0072ff;
      font-weight: 600;
    }

    .form-control {
      border-radius: 25px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
      background-color: #0072ff;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #005bb5;
    }

    .btn-google {
      background-color: white;
      color: #4285F4;
      border: 2px solid #4285F4;
      border-radius: 25px;
      padding: 12px 20px;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all 0.3s ease;
    }

    .btn-google:hover {
      background-color: #f1f1f1;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-google svg {
      width: 24px;
      height: 24px;
    }


    .footer {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }

    .forgot-password {
      text-align: center;
      margin-top: 15px;
    }

    .forgot-password a {
      text-decoration: none;
      color: #0072ff;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <?php include '../util/menu.php'; ?>

  <div class="container mt-5 container-login">
    <h2 class="text-center mb-4">Inicio de Sesión</h2>

    <div id="error" class="alert alert-danger" style="display:none;" role="alert"></div>

    <form id="loginForm" class="w-100">
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
      </div>

      <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
      </div>

      <!-- Botón para iniciar sesión con Google -->
      <div class="d-grid gap-2 mb-3">
        <button type="button" class="btn btn-google">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path fill="#4285F4" d="M24 9.5c3.24 0 6.16 1.15 8.45 3.04l6.35-6.35C34.15 3.44 29.48 1.5 24 1.5 14.96 1.5 7.15 7.18 4.3 14.95l7.68 5.98C13.64 12.72 18.43 9.5 24 9.5z" />
            <path fill="#34A853" d="M9.14 28.11C9.7 30.2 10.78 32.09 12.2 33.5l7.68-5.97C17.6 26.92 16.73 24.3 16.73 21c0-1.19.21-2.33.58-3.39L9.14 28.11z" />
            <path fill="#FBBC05" d="M23.95 40.5c-4.7 0-8.68-2.1-11.36-5.39l-7.67 5.97C10.4 44.91 17.1 48 24 48c5.36 0 10.33-1.8 14.14-4.91l-7.68-5.97C28.61 39.03 26.4 40.5 23.95 40.5z" />
            <path fill="#EA4335" d="M44.5 24.5c0-1.7-.23-3.34-.64-4.91h-20v9.09h11.36c-.5 2.13-2.03 3.92-4.03 5.02l7.67 5.97c4.47-4.14 6.64-9.93 6.64-15.17z" />
          </svg>
          Iniciar Sesión con Google
        </button>
      </div>

      <!-- Enlace para recuperar contraseña -->
      <div class="forgot-password">
        <a href="#">¿Olvidaste tu contraseña?</a>
      </div>
    </form>

    <div class="footer mt-4">
      <p>¿No tienes cuenta? <a href="registrarse.php">Regístrate aquí</a></p>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/iniciarSesion.js"></script>
</body>

</html>








