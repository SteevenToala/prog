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
                
                $sql_vehiculo = $conn->prepare("SELECT marca, modelo,matricula FROM vehiculos WHERE id = ?");
                $sql_vehiculo->bind_param('i',$id_vehiculo);
                $sql_vehiculo->execute();
                $result_vehiculo = $sql_vehiculo->get_result();
                if($result_vehiculo->num_rows>0){
                    while($row = mysqli_fetch_array($result_vehiculo)){
                        $dataV[]=array(
                            'marca' => $row['marca'],
                            'modelo' => $row['modelo'],
                            'matricula' => $row['matricula']
                        );
                    }
                }
                foreach($dataV as $vehiculoxd){
                    $marca = $vehiculoxd['marca'];
                    $modelo =$vehiculoxd['modelo'];
                    $matricula =$vehiculoxd['matricula'];
                }
                
                //AQUI VA LA CONSULTA QUE OBTIENE EL ID DEL VEHICULO PARA AGREGAR AL COMBOBOX EL ID DEL VEHICULO CON SU NOMBRE MARCA Y MODELO
                $conn->commit();                
                echo json_encode([
                    'success' => true,
                    'marca' => $marca,
                    'modelo' => $modelo,
                    'matricula' => $matricula
                    
                ]);
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
