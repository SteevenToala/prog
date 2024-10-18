<?php
include '../../../util/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    // Validar que se haya enviado correctamente
    if (empty($id) || empty($nombre)) {
        echo 'error';
        exit;
    }

    // Actualizar el nombre en la base de datos
    $sql = "UPDATE usuarios SET nombre = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nombre, $id);

    if ($stmt->execute()) {
        echo 'success'; // Respuesta para AJAX
    } else {
        echo 'error'; // Respuesta para AJAX
    }

    $stmt->close();
    $conn->close();
}
?>
