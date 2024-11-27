<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}
include '../util/conexion.php';
$sql = "SELECT alquileres.id, alquileres.fecha_inicio, alquileres.fecha_fin, alquileres.estado, usuarios.nombre AS nombre_usuario, vehiculos.matricula, vehiculos.marca, vehiculos.modelo
            FROM alquileres
            JOIN usuarios ON alquileres.usuario_id = usuarios.id
            JOIN vehiculos ON alquileres.vehiculo_id = vehiculos.id";
$result = mysqli_query($conn, $sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id' => $row['id'],
            'fecha_inicio' => $row['fecha_inicio'],
            'fecha_fin' => $row['fecha_fin'],
            'matricula' => $row['matricula'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'nombre_usuario' => $row['nombre_usuario'],
            'estado' => $row['estado']
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="../styles/footer.css">


    <link rel="stylesheet" href="../styles/home_admin.css">
</head>

<body>
    <?php
    include './home_section/modals/contrato.html';
    include './home_section/modals/modal_addRent.php';
    include './home_section/modals/modal_editRent.php';

    ?>

    <div class="container-fluid vh-100 d-flex flex-column overflow-hidden">
        <div  class="row flex-grow-1 overflow-auto">
            <?php
            include './home_section/scripts/menu.php'
            ?>
            <main class="col-12 mx-auto px-4 main-content d-flex flex-column h-100">
                <h1 class="tittle-p">Gestion Alquileres</h1>
                <div id="alerta2" class="alert d-none" role="alert"></div>
                <table  class="table table-striped mt-4">
                    <thead  class="table-dark">
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th>Matricula</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Contrato</th>
                        <th>Acciones</th>
                        <th></th>
                    </thead>
                    <tbody id="tablaRents">
                        <?php foreach ($data as $rent): ?>
                            <tr id="rent-<?php echo $rent['id']?>">
                                <th><?php echo $rent['fecha_inicio'] ?></th>
                                <th><?php echo $rent['fecha_fin'] ?></th>
                                <th><?php echo $rent['estado'] ?></th>
                                <th class="nombre"><?php echo $rent['nombre_usuario'] ?></th>
                                <th class="matricula"><?php echo $rent['matricula'] ?></th>
                                <th class="marca"><?php echo $rent['marca'] ?></th>
                                <th class="modelo"><?php echo $rent['modelo'] ?></th>
                                <th>
                                    <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#contratoModal"
                                        data-id="<?php echo $rent['id']; ?>"
                                        data-fechaInicio="<?php echo $rent['fecha_inicio']; ?>"
                                        data-nombreUsuario="<?php echo $rent['nombre_usuario']; ?>"
                                        data-matricula="<?php echo htmlspecialchars($rent['matricula'], ENT_QUOTES, 'UTF-8'); ?>">
                                        Ver Contrato
                                    </button>
                                </th>
                                <th>
                                <button class="btn btn-warning btn-sm editar"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModalRent"
                                    data-id="<?php echo $rent['id']; ?>"
                                    data-fechaInicio="<?php echo $rent['fecha_inicio']; ?>"
                                    data-nombreUsuario="<?php echo $rent['nombre_usuario']; ?>"
                                    data-matricula="<?php echo htmlspecialchars($rent['matricula'], ENT_QUOTES, 'UTF-8'); ?>">
                                    Editar
                                </button>
                                </th>
                                <th><button class="btn btn-danger btn-sm eliminar" data-id="<?php echo $rent['id']; ?>">Eliminar</button></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRentModal">Agregar Alquiler</button>
                </div>
            </main>
        </div>
    </div>
    <?php include '../util/footer.html'; ?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
    <script src="./home_section/js/addRent.js"></script>
    <script src="./home_section/js/editRent.js"></script>
    <script src="./home_section/js/removeRent.js"></script>
    <script src="./home_section/js/contrato.js"></script>

</body>

</html>