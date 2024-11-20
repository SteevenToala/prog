<?php
include '../../../util/conexion.php';

$id_rent = $_POST['rent_id'];
$conn->begin_transaction();  // Iniciar la transacción

try {
    // Obtener el ID del vehículo asociado al alquiler
    $sql_id_vehiculo_alquiler = $conn->prepare("SELECT vehiculo_id FROM alquileres WHERE id = ?");
    $sql_id_vehiculo_alquiler->bind_param('i', $id_rent);
    $sql_id_vehiculo_alquiler->execute();
    $result_vehicle = $sql_id_vehiculo_alquiler->get_result();
    
    if ($result_vehicle->num_rows > 0) {
        $row = $result_vehicle->fetch_assoc();
        $id_vehiculo = $row['vehiculo_id'];

        // Actualizar la disponibilidad del vehículo
        $sql_disponibilidad = $conn->prepare("UPDATE vehiculos SET disponibilidad = 'Disponible' WHERE id = ?");
        $sql_disponibilidad->bind_param('i', $id_vehiculo);
        if (!$sql_disponibilidad->execute()) {
            throw new Exception('Error al actualizar la disponibilidad');
        }

        // Eliminar el alquiler
        $sql = "DELETE FROM alquileres WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_rent);
        if (!$stmt->execute() || $stmt->affected_rows <= 0) {
            throw new Exception('Error al eliminar el alquiler o no se afectó ninguna fila');
        }

        // Obtener datos del vehículo
        $sql_vehiculo = $conn->prepare("SELECT marca, modelo, matricula FROM vehiculos WHERE id = ?");
        $sql_vehiculo->bind_param('i', $id_vehiculo);
        $sql_vehiculo->execute();
        $result_vehiculo = $sql_vehiculo->get_result();
        if ($result_vehiculo->num_rows > 0) {
            $row = $result_vehiculo->fetch_assoc();
            $marca = $row['marca'];
            $modelo = $row['modelo'];
            $matricula = $row['matricula'];

            // Confirmar cambios
            $conn->commit();
            echo json_encode([
                'success' => true,
                'marca' => $marca,
                'modelo' => $modelo,
                'id_vehiculo' => $id_vehiculo,
                'matricula' => $matricula
            ]);
        } else {
            throw new Exception('No se encontró el vehículo');
        }
    } else {
        throw new Exception('Error al obtener el ID del vehículo');
    }
} catch (Exception $e) {
    $conn->rollback();  // Deshacer la transacción en caso de error
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $stmt->close();
    $conn->close();
}
?>
