<?php include '../util/conexion.php';
$sql = "SELECT id, marca, modelo,matricula,disponibilidad,tarifa,estado,color,fecha_registro,tipo_vehiculo FROM vehiculos";
$result = mysqli_query($conn, $sql);

$datavehicle = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $datavehicle[] = array(
            'id' => $row['id'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'matricula' => $row['matricula'],
            'disponibilidad' => $row['disponibilidad'],
            'tarifa' => $row['tarifa'],
            'estado' => $row['estado'],
            'tipo_vehiculo' => $row['tipo_vehiculo'],
            'color' => $row['color'],
            'fecha_registro'=> $row['fecha_registro']
        );
    }
} else {
    echo "no existen elementos";
}

$conn->close();
?>
<div id="listVehicles" class="content-section active">
    <h2>Listar Vehiculos</h2>
    <div id="alertaVehicle" class="alert d-none" role="alert"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matricula</th>                
                <th>Tarifa</th>      
                <th>Estado</th>               
                <th>Color</th>                 
                <th>Tipo</th>
                <th>Disponibilidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaUsuarios">
            <?php foreach ($datavehicle as $vehicle) : ?>
                <tr id="vehicle-<?php echo $vehicle['id']; ?>">
                    <td class="marca"><?php echo htmlspecialchars($vehicle['marca'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="modelo"><?php echo htmlspecialchars($vehicle['modelo'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="matricula"><?php echo htmlspecialchars($vehicle['matricula'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="tarifa"><?php echo htmlspecialchars($vehicle['tarifa'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="estado"><?php echo htmlspecialchars($vehicle['estado'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="color"><?php echo htmlspecialchars($vehicle['color'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="tipo"><?php echo htmlspecialchars($vehicle['tipo_vehiculo'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="disponibilidad"><?php echo $vehicle['disponibilidad']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModalVehicle" 
                            data-id="<?php echo $vehicle['id']; ?>" 
                            data-editMarca="<?php echo htmlspecialchars($vehicle['marca'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-editModelo="<?php echo htmlspecialchars($vehicle['modelo'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-editMatricula="<?php echo htmlspecialchars($vehicle['matricula'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-editTarifa="<?php echo htmlspecialchars($vehicle['tarifa'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-editEstado="<?php echo htmlspecialchars($vehicle['estado'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-editTipo="<?php echo htmlspecialchars($vehicle['tipo_vehiculo'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-editDisponibilidad="<?php echo htmlspecialchars($vehicle['disponibilidad'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-editColor="<?php echo htmlspecialchars($vehicle['color'], ENT_QUOTES, 'UTF-8'); ?>">                            
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="<?php echo $vehicle['id']; ?>">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botón para abrir el modal de agregar usuario, centrado -->
    <div class="text-center mt-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal">Agregar Vehiculo</button>
    </div>
</div>


