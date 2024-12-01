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
  <style>
   
    .focus-ring:focus {
        border-color: #0d6efd !important; /* Azul Bootstrap */
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.75);
        background-color: #eaf4ff; /* Azul claro */
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
        <button  type="submit" class="btn btn-primary">Recuperar contraseña</button>
      </div>    
    </form>

    <div class="footer mt-4">
      <p>¿No tienes cuenta? <a href="registrarse.php">Regístrate aquí</a></p>
    </div>
  </div>



  <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="codeModalLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-envelope-check me-2" viewBox="0 0 16 16">
                        <path
                            d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
                        <path
                            d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                    </svg>
                    Introduce el Código de Seguridad
                </h5>                                
            </div>
           
            <div class="modal-body">
                <div id="alertacodigo" class="alert d-none" role="alert"></div>
                <p>Por favor, ingresa el código de 3 dígitos que hemos enviado a tu correo.</p>
                <div class="d-flex justify-content-center gap-2">
                    <input type="text" class="form-control text-center border border-primary rounded shadow focus-ring" maxlength="1" style="width: 3rem; background-color: #f8f9fa;" id="digit1">
                    <input type="text" class="form-control text-center border border-primary rounded shadow focus-ring" maxlength="1" style="width: 3rem; background-color: #f8f9fa;" id="digit2">
                    <input type="text" class="form-control text-center border border-primary rounded shadow focus-ring" maxlength="1" style="width: 3rem; background-color: #f8f9fa;" id="digit3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="verifyCode">Verificar Código</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-lock-fill me-2" viewBox="0 0 16 16">
                        <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
                        <path d="M4.5 7a3.5 3.5 0 0 1 7 0V9h-7V7z"/>
                    </svg>
                    Cambiar Contraseña
                </h5>                
            </div>
            <div class="modal-body">
                <div id="alertaPassword" class="alert d-none" role="alert"></div>
                <p>Por favor, introduce tu nueva contraseña y confírmala para continuar.</p>
                <!-- Nueva Contraseña -->
                <div class="mb-3 position-relative">
                    <label for="newPassword" class="form-label">Nueva Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="newPassword" placeholder="••••••••">
                        <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8a13.133 13.133 0 0 1-1.66 2.043C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z"/>
                                <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM8 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Confirmar Contraseña -->
                <div class="mb-3 position-relative">
                    <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="••••••••">
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8a13.133 13.133 0 0 1-1.66 2.043C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z"/>
                                <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM8 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="cancelarchangecontraseña" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="savePassword">Guardar Contraseña</button>
            </div>
        </div>
    </div>
</div>








<div class="modal fade" id="successPasswordModal" tabindex="-1" aria-labelledby="successPasswordModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successPasswordModalLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                        <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM12.707 5.707a1 1 0 0 0-1.414 0L7 9.586 4.707 7.293a1 1 0 0 0-1.414 1.414L6.293 11a1 1 0 0 0 1.414 0l5-5a1 1 0 0 0 0-1.414z"/>
                    </svg>
                    Contraseña Cambiada Correctamente
                </h5>                
            </div>
            <div class="modal-body">
                <p>Tu contraseña ha sido cambiada con éxito. Ahora puedes usar la nueva contraseña para iniciar sesión.</p>
            </div>
            <div class="modal-footer">
                <button id="cerrarModales" type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/recoverPassword.js"></script>
</body>

</html>





