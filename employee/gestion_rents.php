
<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])||$_SESSION['tipo_usuario']!='empleado'){
        header("Location: ../pages/iniciarSesion.php");
        exit();
    }
    include '../util/conexion.php';
    $sql = "SELECT alquileres.fecha_inicio, alquileres.fecha_fin, alquileres.estado, usuarios.nombre AS nombre_usuario, vehiculos.matricula
            FROM alquileres
            JOIN usuarios ON alquileres.usuario_id = usuarios.id
            JOIN vehiculos ON alquileres.vehiculo_id = vehiculos.id";
    $result = mysqli_query($conn,$sql);

    $data = array();
    if($result->num_rows > 0){
        while($row = mysqli_fetch_array($result)){
            $data[] = array(
                'fecha_inicio'=>$row['fecha_inicio'],
                'fecha_fin'=>$row['fecha_fin'],
                'matricula'=>$row['matricula'],
                'nombre_usuario'=>$row['nombre_usuario'],
                'estado'=>$row['estado']                
            );
        }

    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_admin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include './home_section/scripts/menu.php'
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <h1>Gestion Alquileres</h1>
                <table class="table">
                    <thead>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>                        
                        <th>Cliente</th>
                        <th>Contrato</th>
                        <th>Registrar</th>
                    </thead>
                    <tbody>
                        <?php foreach($data as $vehicle):?>
                            <tr>
                            <th><?php echo $vehicle['fecha_inicio']?></th>
                            <th><?php echo $vehicle['fecha_fin']?></th>
                            <th><?php echo $vehicle['estado']?></th>      
                            <th><?php echo $vehicle['nombre_usuario']?></th>     
                            <th><?php echo $vehicle['matricula']?></th>                            
                            
                            <th><button class="button">Registrar</button></th>
                            </tr>
                        <?php endforeach; ?>    
                            <tr>
                            <th><button class="button">Agregar alquiler</button></th>
                            </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>