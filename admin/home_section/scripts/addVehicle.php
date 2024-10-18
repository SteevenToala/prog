<?php
include '../../../util/conexion.php';

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$matricula = $_POST['matricula'];
$tarifa = $_POST['tarifa'];
$estado = $_POST['estado'];
$color = $_POST['color'];

$sql = $conn ->prepare("INSERT INTO vehiculos(marca,modelo,matricula,tarifa,estado,color)VALUES(?,?,?,?,?,?)");
$sql -> bind_param("ssss",$marca,$modelo,$matricula,$tarifa,$estado,$color);

if($sql -> execute()){
    $id =  $sql->insert_id;
    $fecha_registro = date('Y-m-d H:i:s');
    echo json_encode([
        'succes'=> true,
        'id'=>$id,
        'fecha_registro'=>$fecha_registro
    ]);
}else{

}

?>