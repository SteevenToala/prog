<?php
include '../../../util/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    
    if (empty($id) || empty($nombre)) {
        echo 'error';
        exit;
    }

    
    $sql = "UPDATE usuarios SET nombre = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nombre, $id);

    if ($stmt->execute()) {
        echo 'success'; 
    } else {
        echo 'error'; 
    }

    $stmt->close();
    $conn->close();
}
?>
