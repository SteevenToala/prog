<?php
include '../../../util/conexion.php';

// Obtener el ID del usuario a eliminar desde el formulario
$id_usuario = $_POST['id_usuario'];

// Preparar la consulta SQL para eliminar el usuario
$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id_usuario);

// Ejecutar la declaración
if ($stmt->execute()) {    
    if ($stmt->affected_rows > 0) {
        echo "exitoso"; // Mensaje de éxito
    } else {
        echo "No se encontró un usuario con ese ID."; // Mensaje de error si no se encontró el usuario
    }
} else {
    echo "Error: " . $stmt->error; // Mensaje de error en la ejecución
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
