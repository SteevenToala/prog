<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}
include '../util/conexion.php';
$sql = "SELECT alquileres.id, alquileres.fecha_inicio, alquileres.fecha_fin, alquileres.estado,alquileres.monto_tarifa,alquileres.descripcion_devolucion,alquileres.fecha_devolucion,alquileres.devuelto,alquileres.cargos_extra,alquileres.monto_total, usuarios.nombre AS nombre_usuario, vehiculos.matricula, vehiculos.marca, vehiculos.modelo, vehiculos.imagen
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
            'imagen' => $row['imagen'],
            'nombre_usuario' => $row['nombre_usuario'],
            'estado' => $row['estado'],
            'monto_tarifa' => $row['monto_tarifa'],
            'descripcion_devolucion' => $row['descripcion_devolucion'],
            'fecha_devolucion' => $row['fecha_devolucion'],
            'devuelto' => $row['devuelto'],
            'cargos_extra' => $row['cargos_extra'],
            'monto_total' => $row['monto_total']
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
    <style>
        .xd {
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
    include './home_section/modals/contrato.html';
    include './home_section/modals/modal_editDev.html';

    ?>

    <div class="container-fluid vh-100 d-flex flex-column overflow-hidden">
        <div class="row flex-grow-1 ">
            <?php
            include './home_section/scripts/menu.php'
            ?>
            <main class="col-12 mx-auto px-4 main-content d-flex flex-column h-100">
                <h1 class="tittle-p">Gestion de devoluciones</h1>
                <div id="alerta2" class="alert d-none" role="alert"></div>
                <table class="table table-striped mt-4">
                    <thead class="table-dark">
                        <th>Imagen</th>
                        <th>Vehiculo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha Devolucion</th>
                        <th>Monto Tarifa</th>
                        <th>Cargos Extra</th>
                        <th>Monto Total</th>
                        <th>Descripcion</th>
                        <th>Devuelto</th>
                        <th>Cliente</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="tablaRents">
                        <?php foreach ($data as $rent): ?>
                            <tr id="rent-<?php echo $rent['id'] ?>">
                                <th>
                                    <img src="../images/autos/<?php echo htmlspecialchars($rent['imagen'], ENT_QUOTES, 'UTF-8'); ?>"
                                        alt="Imagen de <?php echo $rent['modelo']; ?>"
                                        style="width: 100px; height: auto; border-radius: 5px;">
                                </th>
                                <th class="matricula"><?php echo $rent['matricula'] ?>/<?php echo $rent['marca'] ?>/<?php echo $rent['modelo'] ?></th>
                                <th><?php echo $rent['fecha_inicio'] ?></th>
                                <th><?php echo $rent['fecha_fin'] ?></th>
                                <th class="fecha"><?php echo $rent['fecha_devolucion'] ?></th>
                                <th class="monto"><?php echo $rent['monto_tarifa'] ?></th>
                                <th class="cargos"><?php echo $rent['cargos_extra'] ?></th>
                                <th class="montoT"><?php echo $rent['monto_total'] ?></th>
                                <th class="descripcion"><?php echo $rent['descripcion_devolucion'] ?></th>
                                <th class="devuelto"><?php echo $rent['devuelto'] ?></th>
                                <th class="nombre"><?php echo $rent['nombre_usuario'] ?></th>
                                <th>
                                    <?php if (!empty($rent['fecha_fin'])): ?>
                                        <button class="btn btn-warning btn-sm editar"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModalRent"
                                            data-id="<?php echo $rent['id']; ?>"
                                            data-fechaDevolucion="<?php echo $rent['fecha_devolucion']; ?>"                                            
                                            data-cargosExtra="<?php echo $rent['cargos_extra']; ?>"
                                            data-descripcionDevolucion="<?php echo $rent['descripcion_devolucion']; ?>"
                                            data-devuelto="<?php echo $rent['devuelto']; ?>"
                                            data-matricula="<?php echo htmlspecialchars($rent['matricula'], ENT_QUOTES, 'UTF-8'); ?>">
                                            Editar
                                        </button>
                                    <?php endif; ?>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </main>
        </div>
    </div>
    <?php include '../util/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./home_section/js/editDev.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const camposFecha = document.querySelectorAll(".fecha_fin");

            // Obtener la fecha actual
            const hoy = new Date();
            hoy.setDate(hoy.getDate()); // Fecha mínima es hoy
            const fechaMinima = hoy.toISOString().split("T")[0];

            // Establecer el atributo min para todos los campos
            camposFecha.forEach((campo) => {
                campo.setAttribute("min", fechaMinima);

                // Validar en el evento de cambio
                campo.addEventListener("change", function() {
                    const fechaSeleccionada = new Date(campo.value);
                    if (fechaSeleccionada <= hoy) {
                        alert("Por favor, selecciona una fecha mayor a hoy.");
                        campo.value = ""; // Limpiar el campo
                    }
                });
            });
        });
    </script>

</body>

</html>