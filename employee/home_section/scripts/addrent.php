<?php
include '../../../util/conexion.php';

$id_vehiculo = intval($_POST['matricula_vehiculo']);
$id_usuario = intval($_POST['nombre_usuario']);
$fecha_inicio = date('Y-m-d');

// Iniciar la transacción para asegurar la integridad
$conn->begin_transaction();

try {    
    $sql = $conn->prepare("INSERT INTO alquileres(vehiculo_id, usuario_id, fecha_inicio) VALUES (?, ?, ?)");
    $sql->bind_param("iis", $id_vehiculo, $id_usuario, $fecha_inicio);

    if ($sql->execute()) {
        $id_alquiler = $sql->insert_id;
        
        $update_sql = $conn->prepare("UPDATE vehiculos SET disponibilidad = 'No disponible' WHERE id = ?");
        $update_sql->bind_param("i", $id_vehiculo);

        if ($update_sql->execute()) {
            // Confirmar la transacción si ambas consultas fueron exitosas
            $vehicle_sql = $conn->prepare("SELECT marca, modelo, matricula FROM vehiculos WHERE id=?");
            $vehicle_sql->bind_param("i", $id_vehiculo);
            $vehicle_sql->execute();
            $result_vehicle = $vehicle_sql->get_result();
            if($result_vehicle->num_rows>0){
            while($row = mysqli_fetch_array($result_vehicle)){
                $dataVehicles[]=array(
                    'marca'=>$row['marca'],
                    'matricula'=>$row['matricula'],
                    'modelo'=>$row['modelo']
                );               
            }     
            foreach($dataVehicles as $vehicle){
                $marca = $vehicle['marca'];
                $modelo = $vehicle['modelo'];
                $matricula = $vehicle['matricula'];
            }     
            
            $usuario_sql = $conn->prepare("SELECT nombre FROM usuarios WHERE id=?");
            $usuario_sql->bind_param("i",$id_usuario);
            $usuario_sql->execute();
            $result_usuario = $usuario_sql->get_result();
            if($result_usuario->num_rows>0){
                while($rowU = mysqli_fetch_array($result_usuario)){
                    $dataUsers[] = array(
                        'nombre'=>$rowU['nombre']
                    );

                }
                foreach($dataUsers as $user){
                    $conn->commit();            
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
                    ]);
                }

            }else{
                $conn->rollback();
                echo json_encode(['success' => false, 'message' => 'Error no existen usuarios']);
            }
                        
            } else{                
                $conn->rollback();
                echo json_encode(['success' => false, 'message' => 'Error no existen vehiculos disponibles']);
            }
            
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