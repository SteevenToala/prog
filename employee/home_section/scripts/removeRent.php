<?php
include '../../../util/conexion.php';

$id_rent = $_POST['rent_id'];


$sql_id_vehiculo_alquiler = $conn->prepare("SELECT vehiculo_id FROM alquileres WHERE id =?");
$sql_id_vehiculo_alquiler->bind_param('i', $id_rent);
$sql_id_vehiculo_alquiler->execute();
$result_vehicle = $sql_id_vehiculo_alquiler->get_result();
if ($result_vehicle->num_rows > 0) {
    while ($row = mysqli_fetch_array($result_vehicle)) {
        $data[] = array(
            'vehiculo_id' => $row['vehiculo_id']
        );
    }
    foreach ($data as $vehiculo) {
        $id_vehiculo = $vehiculo['vehiculo_id'];
    }

    $sql_disponibilidad = $conn->prepare("UPDATE vehiculos SET disponibilidad = 'Disponible' WHERE id = ?");
    $sql_disponibilidad->bind_param('i', $id_vehiculo);
    if ($sql_disponibilidad->execute()) {
        $sql = "DELETE FROM alquileres WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_rent);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                
                
                
                
                //AQUI VA LA CONSULTA QUE OBTIENE EL ID DEL VEHICULO PARA AGREGAR AL COMBOBOX EL ID DEL VEHICULO CON SU NOMBRE MARCA Y MODELO
                /*$conn->commit();                
                echo json_encode([
                    'success' => true,
                    'id' => $id_alquiler,
                    'fecha_inicio' => $fecha_inicio,
                    'id_usuario' => $id_usuario,
                    'marca' => $marca,
                    'modelo' => $modelo,
                    'matricula' => $matricula,
                    'nombre' => $user['nombre'],
                    'id_vehiculo' => $id_vehiculo
                ]);*/
            } else {
                $conn->rollback();
                echo json_encode(['success' => true, 'message' => 'No se afecto a ninguna columna']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: '.$stmt->error]);            
        }
    } else {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la disponibilidad']);
    }
} else {        
        echo json_encode(['success' => false, 'message' => 'Error al obtener id del vehiculo']);
}


$stmt->close();
$conn->close();
