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
    <h2 class="text-center mb-4">Recuperar contraseña</h2>

    <div id="error" class="alert alert-danger" style="display:none;" role="alert"></div>

    <form id="recoverForm" class="w-100">
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu email" required>
      </div>      

      <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
      </div>    
    </form>

    <div class="footer mt-4">
      <p>¿No tienes cuenta? <a href="registrarse.php">Regístrate aquí</a></p>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/recoverPassword.js"></script>
</body>

</html>





