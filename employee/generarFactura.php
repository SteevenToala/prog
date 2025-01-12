<?php
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php'; // Ajusta la ruta a TCPDF según tu instalación
include '../util/conexion.php'; // Incluye la conexión a la base de datos

// Verifica si el ID fue enviado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de devolución no proporcionado');
}

$devolucion_id = intval($_GET['id']);

// Consulta para obtener los datos de la devolución
$sql = "SELECT 
            devoluciones.*, 
            alquileres.fecha_inicio, alquileres.fecha_fin, 
            usuarios.nombre AS nombre_usuario,
            vehiculos.matricula, vehiculos.marca, vehiculos.modelo
        FROM devoluciones
        JOIN alquileres ON devoluciones.alquiler_id = alquileres.id
        JOIN usuarios ON alquileres.usuario_id = usuarios.id
        JOIN vehiculos ON alquileres.vehiculo_id = vehiculos.id
        WHERE devoluciones.id = $devolucion_id";

$result = mysqli_query($conn, $sql);
if ($result->num_rows === 0) {
    die('Devolución no encontrada');
}

$data = mysqli_fetch_assoc($result);

// Crear el PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Gestión de Alquileres');
$pdf->SetTitle('Factura de Devolución');
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();

// Contenido del PDF
$html = <<<EOD
<h1 style="text-align: center;">Factura de Devolución</h1>
<hr>
<p><strong>Cliente:</strong> {$data['nombre_usuario']}</p>
<p><strong>Vehículo:</strong> {$data['matricula']} - {$data['marca']} {$data['modelo']}</p>
<p><strong>Fecha de Alquiler:</strong> {$data['fecha_inicio']} a {$data['fecha_fin']}</p>
<p><strong>Fecha de Devolución:</strong> {$data['fecha_devolucion']}</p>
<p><strong>Estado del Vehículo:</strong> {$data['estado_vehiculo']}</p>
<p><strong>Nivel de Combustible:</strong> {$data['nivel_combustible']}</p>
<p><strong>Limpieza:</strong> {$data['limpieza']}</p>
<p><strong>Daños Visibles:</strong> {$data['daños_visibles']}</p>
<p><strong>Costo Total:</strong> \$ {$data['costo_total']}</p>
<p><strong>Observaciones:</strong> {$data['observaciones']}</p>
<hr>
<p style="text-align: center;">Gracias por utilizar nuestros servicios</p>
EOD;

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("Factura_Devolucion_{$devolucion_id}.pdf", 'D'); // Forzar descarga
?>
