<?php include '../util/conexion.php';
$sql ="SELECT id,nombre, fecha_registro FROM usuarios";
$result = mysqli_query($conn, $sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'fecha_registro'=> $row['fecha_registro']
        );
    }
}else{
    echo "no existen elementos";
}

$conn->close();?>
<div id="listUsers" class="content-section">
    <h2>Listar Usuarios</h2>
    <div id="alerta2" class="alert d-none" role="alert"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre de Usuario</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($data as $usuario) {
                echo '<tr>
                <td>' . $usuario['nombre'] . '</td>                
                <td>'.$usuario['fecha_registro'].'</td>
                <td>
                    <button class="btn btn-warning btn-sm">Editar</button>
                    <button class="btn btn-danger btn-sm eliminar" data-id="'.$usuario['id'].'" >Eliminar</button>
                </td>
            </tr>';
                
            }
            ?>
        </tbody>
    </table>
</div>