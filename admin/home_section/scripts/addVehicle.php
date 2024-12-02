<?php
include '../../../util/conexion.php';

// Recuperar datos del formulario
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$matricula = $_POST['matricula'];
$tarifa = $_POST['tarifa'];
$estado = $_POST['estado'];
$color = $_POST['color'];
$disponibilidad = $_POST['disponibilidad'];

// Manejo de la imagen
$imagenNombre = $_FILES['imagen']['name'];
$imagenTmp = $_FILES['imagen']['tmp_name'];
$directorioDestino = "../../../images/autos/";

// Verificar que la carpeta existe, si no, crearla
if (!file_exists($directorioDestino)) {
    mkdir($directorioDestino, 0777, true);
}

// Generar un nombre único para evitar colisiones
$nombreUnicoImagen = uniqid() . "_" . basename($imagenNombre);
$rutaFinalImagen = $directorioDestino . $nombreUnicoImagen;

// Mover la imagen al directorio destino
if (move_uploaded_file($imagenTmp, $rutaFinalImagen)) {
    // Insertar datos en la base de datos
    $sql = $conn->prepare("INSERT INTO vehiculos(marca, modelo, matricula, tarifa, estado, color, disponibilidad, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssss", $marca, $modelo, $matricula, $tarifa, $estado, $color, $disponibilidad, $nombreUnicoImagen);

    if ($sql->execute()) {
        $id = $sql->insert_id;
        $fecha_registro = date('Y-m-d H:i:s');
        echo json_encode([
            'success' => true,
            'id' => $id,
            'marca' => $marca,
            'modelo' => $modelo,
            'matricula' => $matricula,
            'tarifa' => $tarifa,
            'estado' => $estado,
            'color' => $color,
            'disponibilidad' => $disponibilidad,
            'imagen' => $nombreUnicoImagen,
            'fecha_registro' => $fecha_registro
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar en la base de datos']);
    }
    $sql->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error al subir la imagen']);
}

// Cerrar conexión
mysqli_close($conn);
?>

