<?php
include '../../../util/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fecha_fin = $_POST['fecha_fin'];
    

    
    if (empty($id) || empty($fecha_fin)) {
        echo 'error';
        exit;
    }
    

    
    $sql = "UPDATE alquileres SET fecha_fin = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $fecha_fin, $id);

    if ($stmt->execute()) {
        echo 'success'; 
    } else {
        echo 'error'; 
    }

    $stmt->close();
    $conn->close();
}
?>
