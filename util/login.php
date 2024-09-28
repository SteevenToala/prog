<?php
// Iniciar sesión para mantener la sesión activa si el login es exitoso
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include 'conexion.php'; // Asegúrate de que este archivo esté correcto y establezca la conexión

// Inicializar variable de error
$error = '';

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta para obtener el usuario por email
$sql = "SELECT id, password, tipo_usuario FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($password, $usuario['password'])) {
        // Guardar la información del usuario en la sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

        // Devolver un JSON de éxito
        echo json_encode(['success' => true, 'tipo_usuario' => $usuario['tipo_usuario']]);
        exit();
    } else {
        // Contraseña incorrecta
        $error = "Contraseña incorrecta.";
    }
} else {
    // No se encontró el usuario
    $error = "No se encontró el usuario.";
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Si hay un error, devolverlo en formato JSON
echo json_encode(['success' => false, 'error' => $error]);
exit();
?>
