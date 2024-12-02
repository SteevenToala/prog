<?php
session_start();


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
    <style>
        .eliminarR {
            color: black;
        }
        .xd{
            display: flex;
            width: 90%;
            height: 90%;
            background-color: aliceblue;
            border-radius: 20px;
            padding: 10px;
            overflow-x: scroll;
        }
    </style>
</head>

<body>

 <?php
 include './home_section/modals/modal_editUser.html'; 
 include './home_section/modals/modal_addUser.html'; 
 
 ?>


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php
            include './home_section/scripts/menu.php';
            ?>

            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <h1>Bienvenido, Administrador</h1>
                
                <div class="xd">
                <!-- Sección de Listar Vehiculos -->
                <?php include './home_section/listUser.php'; ?>
                </div>                                

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>          
    <script src="./home_section/js/addUser.js"></script>
    <script src="./home_section/js/editUser.js"></script>
    <!-- Al final del archivo antes de cerrar el </body> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="./home_section/js/removeUser.js"></script>          
</body>

</html>