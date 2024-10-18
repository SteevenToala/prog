<?php
include '../../../util/conexion.php';

// Depurar para ver qué se está recibiendo en el POST
//var_dump($_POST); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asignación de variables
    $id = $_POST['id']; // Asegúrate de que estas claves coincidan con las que envías en tu AJAX
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $matricula = $_POST['matricula'];
    $tarifa = $_POST['tarifa'];
    $estado = $_POST['estado'];
    $color = $_POST['color'];

    // Validar los datos recibidos
    if (empty($id) || empty($marca) || empty($modelo) || empty($matricula) || empty($tarifa) || empty($estado) || empty($color)) {
        echo 'error: invalid input'; // Mensaje más específico
        exit;
    }

    // Validar que tarifa sea un número válido
    if (!is_numeric($tarifa) || $tarifa < 0) {
        echo 'error: tarifa must be a valid number greater than or equal to 0';
        exit;
    }

    // Consulta para actualizar el vehículo
    $sql = "UPDATE vehiculos SET marca = ?, modelo = ?, matricula = ?, tarifa = ?, estado = ?, color = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la consulta se preparó correctamente
    if ($stmt) {
        // Vincular los parámetros correctamente
        $stmt->bind_param("sssdssi", $marca, $modelo, $matricula, $tarifa, $estado, $color, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo 'success'; // Respuesta correcta para el AJAX
        } else {
            // Mostrar el error específico si la ejecución falla
            echo 'error: ' . $stmt->error;
        }
    } else {
        // Mostrar el error específico si la consulta no pudo prepararse
        echo 'error: ' . $conn->error;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>
