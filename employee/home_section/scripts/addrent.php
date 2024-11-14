<?php
include '../../../util/conexion.php';

$id_vehiculo = intval($_POST['matricula_vehiculo']);
$id_usuario = intval($_POST['nombre_usuario']);
$fecha_inicio = date('Y-m-d');

// Iniciar la transacción para asegurar la integridad
$conn->begin_transaction();

try {
    // Insertar el alquiler
    $sql = $conn->prepare("INSERT INTO alquileres(vehiculo_id, usuario_id, fecha_inicio) VALUES (?, ?, ?)");
    $sql->bind_param("iis", $id_vehiculo, $id_usuario, $fecha_inicio);

    if ($sql->execute()) {
        $id_alquiler = $sql->insert_id;

        // Actualizar la disponibilidad del vehículo
        $update_sql = $conn->prepare("UPDATE vehiculos SET disponibilidad = 'No disponible' WHERE id = ?");
        $update_sql->bind_param("i", $id_vehiculo);

        if ($update_sql->execute()) {
            // Confirmar la transacción si ambas consultas fueron exitosas
            $conn->commit();
            
            echo json_encode([
                'success' => true,
                'id' => $id_alquiler,
                'fecha_inicio' => $fecha_inicio,
                'id_usuario' => $id_usuario,
                'id_vehiculo' => $id_vehiculo
            ]);
        } else {
            // Revertir la transacción si falla la actualización
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la disponibilidad del vehículo']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar el alquiler']);
    }

    // Cerrar los statements
    $sql->close();
    $update_sql->close();

} catch (Exception $e) {
    // Manejo de excepciones en caso de errores inesperados
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Error en la transacción: ' . $e->getMessage()]);
}

mysqli_close($conn);

?>