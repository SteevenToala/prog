<?php
include '../../../util/conexion.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $matricula = $_POST['matricula'];
    $tarifa = $_POST['tarifa'];
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo_vehiculo'];
    $disponibilidad = $_POST['disponibilidad'];
    $color = $_POST['color'];

    
    if (empty($id) || empty($marca) || empty($modelo) || empty($matricula) || empty($tarifa) || empty($estado) || empty($color)|| empty($disponibilidad)|| empty($tipo)) {
        echo 'error: invalid input';
        exit;
    }

    
    if (!is_numeric($tarifa) || $tarifa < 0) {
        echo 'error: tarifa must be a valid number greater than or equal to 0';
        exit;
    }

    
    $sql = "UPDATE vehiculos SET marca = ?, modelo = ?, matricula = ?, tarifa = ?, estado = ?, disponibilidad = ?, color = ?, tipo_vehiculo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    
    if ($stmt) {
        
        $stmt->bind_param("sssdssssi", $marca, $modelo, $matricula, $tarifa, $estado,$disponibilidad, $color,$tipo, $id);

        
        if ($stmt->execute()) {
            echo 'success'; 
        } else {
            
            echo 'error: ' . $stmt->error;
        }
    } else {
        
        echo 'error: ' . $conn->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
