<?php
include '../../../util/conexion.php';

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$matricula = $_POST['matricula'];
$tarifa = $_POST['tarifa'];
$estado = $_POST['estado'];
$color = $_POST['color'];
$disponibilidad = $_POST['disponibilidad'];

$sql = $conn ->prepare("INSERT INTO vehiculos(marca,modelo,matricula,tarifa,estado,color,disponibilidad)VALUES(?,?,?,?,?,?,?)");
$sql -> bind_param("sssssss",$marca,$modelo,$matricula,$tarifa,$estado,$color,$disponibilidad);

if($sql -> execute()){
    $id =  $sql->insert_id;
    $fecha_registro = date('Y-m-d H:i:s');
    echo json_encode([
        'success'=> true,
        'id'=>$id,
        'marca'=>$marca,
        'modelo'=>$modelo,
        'matricula'=>$matricula,
        'tarifa'=>$tarifa,
        'estado'=>$estado,
        'color'=>$color,
        'disponibilidad'=>$disponibilidad,
        'fecha_registro'=>$fecha_registro
    ]);
}else{
    echo json_encode(['success' => false, 'message' => 'Error al insertar usuario']);
}
$sql->close();
mysqli_close($conn);
?>