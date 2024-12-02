<?php
include "../util/conexion.php";

// Manejar la búsqueda
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = "SELECT id, marca, modelo, matricula, disponibilidad, tarifa, estado, color, imagen FROM vehiculos";
if ($search !== '') {
    $sql .= " WHERE marca LIKE '%$search%' OR modelo LIKE '%$search%' OR matricula LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);
$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id' => $row['id'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'matricula' => $row['matricula'],
            'disponibilidad' => $row['disponibilidad'],
            'tarifa' => $row['tarifa'],
            'estado' => $row['estado'],
            'color' => $row['color'],
            'imagen' => $row['imagen']
        );
    }
} else {
    $data = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/background.css">
    <title>Catálogo de Vehículos</title>
    <style>
        
        .container {
            max-width: 1200px;
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        .card img {
            height: 220px;
            object-fit: cover;
            border-bottom: 5px solid #007bff;
        }
        .card-body {
            background: #ffffff;
            border-radius: 0 0 15px 15px;
        }
        .card-title {
            font-size: 1.25rem;
            color: #007bff;
            font-weight: bold;
        }
        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            color: white;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #004494);
        }
        .text-muted {
            font-size: 0.8rem;
        }
        h1 {
            color: #004494;
            font-weight: 700;
            text-transform: uppercase;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<?php include "../util/menu.php"; ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Catálogo de Vehículos</h1>

    <!-- Barra de búsqueda -->
    <div class="mb-4">
        <div class="input-group">
            <input type="text" id="searchBar" class="form-control" placeholder="Buscar por marca, modelo o matrícula">
        </div>
    </div>

    <!-- Contenedor de resultados -->
    <div class="row g-4" id="vehicleCatalog">
        <?php foreach ($data as $vehiculo): ?>
            <div class="col-md-4 vehicle-card" data-marca="<?= strtolower($vehiculo['marca']) ?>" 
                                              data-modelo="<?= strtolower($vehiculo['modelo']) ?>" 
                                              data-matricula="<?= strtolower($vehiculo['matricula']) ?>">
                <div class="card">
                    <img src="../images/autos/<?= $vehiculo['imagen'] ?>" class="card-img-top" alt="<?= $vehiculo['marca'] ?> <?= $vehiculo['modelo'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $vehiculo['marca'] ?> <?= $vehiculo['modelo'] ?></h5>
                        <p class="card-text">
                            Matrícula: <span class="text-muted"><?= $vehiculo['matricula'] ?></span><br>
                            Disponibilidad: <span class="text-muted"><?= $vehiculo['disponibilidad'] ?></span><br>
                            Tarifa: <span class="text-muted">$<?= number_format($vehiculo['tarifa'], 2) ?> / día</span><br>
                            Estado: <span class="text-muted"><?= $vehiculo['estado'] ?></span><br>
                            Color: <span class="text-muted"><?= $vehiculo['color'] ?></span>
                        </p>
                        <div class="d-grid">
                            <button class="btn btn-primary">Ver más detalles</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const searchBar = document.getElementById('searchBar');
    const vehicleCards = document.querySelectorAll('.vehicle-card');

    searchBar.addEventListener('input', () => {
        const query = searchBar.value.toLowerCase();

        vehicleCards.forEach(card => {
            const marca = card.getAttribute('data-marca');
            const modelo = card.getAttribute('data-modelo');
            const matricula = card.getAttribute('data-matricula');

            if (marca.includes(query) || modelo.includes(query) || matricula.includes(query)) {
                card.style.display = ''; 
            } else {
                card.style.display = 'none'; 
            }
        });
    });
</script>
</body>
</html>
