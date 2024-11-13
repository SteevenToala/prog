<?php
session_start();

// Verificar si el usuario está autenticado y es un usuario normal
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}


include '../util/conexion.php';

$sql = "SELECT id,marca,modelo,matricula,estado,tipo_vehiculo FROM vehiculos WHERE disponibilidad='Disponible'";
$result = mysqli_query($conn, $sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id' => $row['id'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'matricula' => $row['matricula'],
            'estado' => $row['estado'],
            'tipo_vehiculo' => $row['tipo_vehiculo']
        );
    }
} else {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tabla = document.getElementById('tablaBody');
        var fila = tabla.insertRow();
        var celda = fila.insertCell(0);
        celda.innerHTML='No existen vechiculos disponibles';});
    </script>";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vehiculos Disponibles - Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_admin.css">
    <link rel="stylesheet" href="../styles/footer.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php
            include './home_section/scripts/menu.php';
            ?>

            <!-- Contenido Principal -->
            <main class="col-12 mx-auto px-4 main-content d-flex flex-column h-100">
                <h1>Vehiculos Disponibles</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Matricula</th>
                            <th>Estado</th>
                            <th>Tipo vehiculo</th>
                        </tr>
                    </thead>
                    <tbody id="tablaBody">
                        <?php foreach ($data as $vehiculo): ?>
                            <tr>
                                <th><?php echo $vehiculo['marca'] ?></th>
                                <th><?php echo $vehiculo['modelo'] ?></th>
                                <th><?php echo $vehiculo['matricula'] ?></th>
                                <th><?php echo $vehiculo['estado'] ?></th>
                                <th><?php echo $vehiculo['tipo_vehiculo'] ?></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </main>
        </div>
    </div>
    <?php include '../util/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>

</html>