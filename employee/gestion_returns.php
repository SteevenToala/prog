<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])||$_SESSION['tipo_usuario']!='empleado'){
        header("Location: ../pages/iniciarSesion.php");
        exit();
    }

    include '../util/conexion.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_admin.css">
    <title>Gestion de devoluciones</title>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include './home_section/scripts/menu.php'
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <h1>Gestion de devoluciones</h1>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>