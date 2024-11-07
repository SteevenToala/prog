<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}
include '../util/conexion.php';
$sql = "SELECT alquileres.id, alquileres.fecha_inicio, alquileres.fecha_fin, alquileres.estado, usuarios.nombre AS nombre_usuario, vehiculos.matricula
            FROM alquileres
            JOIN usuarios ON alquileres.usuario_id = usuarios.id
            JOIN vehiculos ON alquileres.vehiculo_id = vehiculos.id";
$result = mysqli_query($conn, $sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id'=>$row['id'],
            'fecha_inicio' => $row['fecha_inicio'],
            'fecha_fin' => $row['fecha_fin'],
            'matricula' => $row['matricula'],
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_admin.css">
</head>

<body>
    <?php
    include './home_section/modals/contrato.html';
    include './home_section/modals/modal_addRent.php';

    ?>

    <div class="container-fluid">
        <div class="row">
            <?php
            include './home_section/scripts/menu.php'
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <h1>Gestion Alquileres</h1>
                <table class="table">
                    <thead>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th>Matricula</th>
                        <th>Contrato</th>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $vehicle): ?>
                            <tr>
                                <th><?php echo $vehicle['fecha_inicio'] ?></th>
                                <th><?php echo $vehicle['fecha_fin'] ?></th>
                                <th><?php echo $vehicle['estado'] ?></th>
                                <th><?php echo $vehicle['nombre_usuario'] ?></th>
                                <th><?php echo $vehicle['matricula'] ?></th>
                                <th>
                                    <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#contratoModal"
                                        data-id="<?php echo $vehicle['id']; ?>"
                                        data-fechaInicio="<?php echo $vehicle['fecha_inicio']; ?>"
                                        data-nombreUsuario="<?php echo $vehicle['nombre_usuario']; ?>"
                                        data-matricula="<?php echo htmlspecialchars($vehicle['matricula'], ENT_QUOTES, 'UTF-8'); ?>">
                                        Ver Contrato
                                    </button>
                                </th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Script para pasar datos al modal
        var editModal = document.getElementById('contratoModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Botón que activa el modal
            var userId = button.getAttribute('data-id'); // Obtener el id del usuario            
            var matricula =button.getAttribute('data-matricula');            
            var nombre_usuario =button.getAttribute('data-nombreUsuario');
            var fechaI =button.getAttribute('data-fechaInicio');
            // Asignar los valores a los campos del modal
            
            document.getElementById('matriculaC').innerHTML =" "+ matricula;
            document.getElementById('nombreC').innerHTML =" "+ nombre_usuario;
            document.getElementById('fechaI').innerHTML =" "+ fechaI;
            
        });

        // Limpiar el modal al cerrarse para evitar que queden valores antiguos
        $('#contratoModal').on('hidden.bs.modal', function() {
            $('#editForm')[0].reset(); // Restablecer el formulario
        });
    </script>
    <script>

    </script>

</body>

</html>