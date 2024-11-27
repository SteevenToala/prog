<?php
include '../../../util/conexion.php';

$id_vehicle = $_POST['id_vehiculo'];
$id_usuario = $_POST['id_usuario'];
$id_alquiler = $_POST['id_alquiler'];

$conn->begin_transaction();

try {    
    function fetchSingleResult($conn, $query, $types, ...$params) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            throw new Exception("No se encontraron datos para la consulta: $query");
        }
        return $result->fetch_assoc();
    }
    
    $vehiculo_actual = fetchSingleResult($conn, "SELECT id, marca, modelo, matricula FROM vehiculos WHERE id = ?", "i", $id_vehicle);
    $usuario_actual = fetchSingleResult($conn, "SELECT id, nombre FROM usuarios WHERE id = ?", "i", $id_usuario);
    $alquiler_actual = fetchSingleResult($conn, "SELECT vehiculo_id, usuario_id FROM alquileres WHERE id = ?", "i", $id_alquiler);

    $vehiculo_antiguo = fetchSingleResult($conn, "SELECT id, marca, modelo, matricula FROM vehiculos WHERE id = ?", "i", $alquiler_actual['vehiculo_id']);
    $usuario_antiguo = fetchSingleResult($conn, "SELECT id, nombre FROM usuarios WHERE id = ?", "i", $alquiler_actual['usuario_id']);

    
    $stmt = $conn->prepare("UPDATE alquileres SET usuario_id = ?, vehiculo_id = ? WHERE id = ?");
    $stmt->bind_param("iii", $id_usuario, $id_vehicle, $id_alquiler);
    if (!$stmt->execute()) {
        throw new Exception("Error al actualizar el alquiler");
    }

    $stmt2 = $conn->prepare("UPDATE vehiculos SET disponibilidad = 'No disponible' WHERE id = ?");
    $stmt2->bind_param("i",  $id_vehicle);
    if (!$stmt2->execute()) {
        throw new Exception("Error al actualizar el vehiculo actual");
    }


    $stmt3 = $conn->prepare("UPDATE vehiculos SET disponibilidad = 'Disponible' WHERE id = ?");
    $stmt3->bind_param("i", $vehiculo_antiguo['id']);
    if (!$stmt3->execute()) {
        throw new Exception("Error al actualizar el vehiculo antiguo");
    }


    $conn->commit();

    
    echo json_encode([
        'success' => true,
        'vehiculo_antiguo' => $vehiculo_antiguo,
        'usuario_antiguo' => $usuario_antiguo,
        'vehiculo_actual' => $vehiculo_actual,
        'usuario_actual' => $usuario_actual,
        'message' => 'Alquiler actualizado exitosamente'
    ]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
?>
