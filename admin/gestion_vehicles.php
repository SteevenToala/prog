<?php
session_start();

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_admin.css">
    <link rel="stylesheet" href="./home_section/styles/menuA.css">
    <link rel="stylesheet" href="./home_section/styles/modeladdVehicle.css">
    
    <style>
        .eliminarR {
            color: black;
        }

        .xd {
            display: flex;
            width: 90%;
            height: 90%;
            background-color: aliceblue;
            border-radius: 20px;
            padding: 10px;
            overflow-x: scroll;
            margin: 0 auto;
        }

        /* General */
        .sidebar {
            transition: transform 0.3s ease-in-out;
            height: 100vh;
            position: fixed;
            z-index: 1030;
            top: 0;
            left: 0;
            width: 250px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        /* Ocultar el menú por defecto en pantallas pequeñas */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            /* Mostrar el menú cuando el checkbox esté marcado */
            #menu-toggle:checked~.sidebar {
                transform: translateX(0);
            }

            /* Ajustes al encabezado del menú */
            .sidebar h4 {
                font-size: 1.2rem;
            }

            .nav-item .nav-link {
                font-size: 1rem;
            }
        }

        /* Botón para alternar el menú */
        .sidebar-toggler-label {
            display: none;
            position: fixed;

            background-color: #ffffff;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            font-size: 1.5rem;
            z-index: 1040;
            cursor: pointer;
        }

        .sidebar-toggler-label i {
            color: #333;
        }

        /* Mostrar el botón solo en pantallas pequeñas */
        @media (max-width: 768px) {
            .sidebar-toggler-label {
                display: inline-block;
            }
        }
    </style>
</head>

<body>

    <?php
    include './home_section/modals/modal_editVehicle.html';
    include './home_section/modals/modal_addVehicle.html';

    ?>


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php
            include './home_section/scripts/menu.php';
            ?>

            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content" style="width:100%">            

                <div class="xd">
                    <!-- Sección de Listar Vehiculos -->
                    <?php include './home_section/listVehicle.php'; ?>
                </div>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./home_section/js/addVehicle.js"></script>
    <script src="./home_section/js/editVehicle.js"></script>
    <script src="./home_section/js/removeVehicle.js"></script>
</body>

</html>