<?php
include '../../../util/conexion.php';

// Obtener el ID del usuario a eliminar desde el formulario
$id_vehicle = $_POST['id_vehicle'];

// Preparar la consulta SQL para eliminar el usuario
$sql = "DELETE FROM vehiculos WHERE id = ?";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Vincular el parámetro (asumiendo que id es un entero)
$stmt->bind_param("i", $id_vehicle);

// Ejecutar la declaración
if ($stmt->execute()) {    
    if ($stmt->affected_rows > 0) {
        echo "exitoso"; // Mensaje de éxito
    } else {
        echo "No se encontró un vehiculo con ese ID."; // Mensaje de error si no se encontró el usuario
    }
} else {
    echo "Error: " . $stmt->error; // Mensaje de error en la ejecución
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
