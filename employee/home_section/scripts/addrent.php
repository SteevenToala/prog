<?php
include '../../../util/conexion.php';

$id_vehiculo = intval($_POST['matricula_vehiculo']);
$id_usuario = intval($_POST['nombre_usuario']);
$fecha_inicio = date('Y-m-d');
$fecha_fin=$_POST['fecha_fin_1'];

$conn->begin_transaction();

try {    
    $sql = $conn->prepare("INSERT INTO alquileres(vehiculo_id, usuario_id, fecha_inicio,fecha_fin) VALUES (?, ? , ?, ?)");
    $sql->bind_param("iiss", $id_vehiculo, $id_usuario, $fecha_inicio,$fecha_fin);

    if ($sql->execute()) {
        $id_alquiler = $sql->insert_id;
        
        $update_sql = $conn->prepare("UPDATE vehiculos SET disponibilidad = 'No disponible' WHERE id = ?");
        $update_sql->bind_param("i", $id_vehiculo);

        if ($update_sql->execute()) {
            
            $vehicle_sql = $conn->prepare("SELECT marca, modelo, matricula,imagen FROM vehiculos WHERE id=?");
            $vehicle_sql->bind_param("i", $id_vehiculo);
            $vehicle_sql->execute();
            $result_vehicle = $vehicle_sql->get_result();
            if($result_vehicle->num_rows>0){
            while($row = mysqli_fetch_array($result_vehicle)){
                $dataVehicles[]=array(
                    'marca'=>$row['marca'],
                    'matricula'=>$row['matricula'],
                    'modelo'=>$row['modelo'],
                    'imagen'=>$row['imagen']
                );               
            }     
            foreach($dataVehicles as $vehicle){
                $marca = $vehicle['marca'];
                $modelo = $vehicle['modelo'];
                $matricula = $vehicle['matricula'];
                $imagen = $vehicle['imagen'];
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
                        'fecha_fin' => $fecha_fin,
                        'id_usuario' => $id_usuario,
                        'marca' => $marca,
                        'modelo' => $modelo,
                        'matricula' => $matricula,
                        'imagen' => $imagen,
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
            
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la disponibilidad del vehículo']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar el alquiler']);
    }

    
    $sql->close();
    $update_sql->close();

} catch (Exception $e) {
    
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Error en la transacción: ' . $e->getMessage()]);
}

mysqli_close($conn);

?>