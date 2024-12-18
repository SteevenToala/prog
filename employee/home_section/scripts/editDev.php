<?php
// Habilitar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$hostname = "localhost";
$username = "root";
$password = "";
$database = "prog";

$conn = new mysqli($hostname, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Error en la conexión a la base de datos: " . $conn->connect_error
    ]);
    exit;
}

// Validar método de solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos enviados
    if (isset($_POST['editRentID'], $_POST['descripcion_devolucion'], $_POST['fecha_devolucion'], $_POST['devuelto'], $_POST['cargos_extra'])) {
        $editRentID = intval($_POST['editRentID']);
        $descripcion_devolucion = $conn->real_escape_string($_POST['descripcion_devolucion']);
        $fecha_devolucion = $conn->real_escape_string($_POST['fecha_devolucion']);
        $devuelto = intval($_POST['devuelto']);
        $cargos_extra = floatval($_POST['cargos_extra']);

        // Consulta para actualizar el alquiler
        $query = "UPDATE alquileres SET 
                  descripcion_devolucion = ?, 
                  fecha_devolucion = ?, 
                  devuelto = ?, 
                  cargos_extra = ? 
                  WHERE id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssii", $descripcion_devolucion, $fecha_devolucion, $devuelto, $cargos_extra, $editRentID);

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Alquiler actualizado correctamente."
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Error al actualizar el alquiler: " . $stmt->error
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Faltan datos en la solicitud."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido. Se requiere POST."
    ]);
}

$conn->close();
