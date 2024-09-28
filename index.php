<?php
include './util/conexion.php';

session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario_id'])) {
    // Redirigir según el tipo de usuario
    if ($_SESSION['tipo_usuario'] === 'administrador') {
        header("Location: admin/home_admin.php");
        exit();
    } elseif ($_SESSION['tipo_usuario'] === 'empleado') {
        header("Location: employee/home_employee.php");
        exit();
    } else {
        header("Location: client/home_client.php");
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">  
    <link rel="stylesheet" href="./styles/index.css">
    <title>Alquiler de Autos Premium</title>
    <style>
       
    </style>
</head>

<body>

    <!-- Menú -->
    <?php include './util/menuindex.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section d-flex flex-column justify-content-center align-items-center">
        <div class="hero-overlay"></div>
        <h1>Encuentra el Auto Perfecto</h1>
        <p>Viaja con estilo y comodidad, a tu propio ritmo.</p>
        <a href="#" class="btn btn-primary">Explorar Autos</a>
    </section>

    <!-- Sección de Galería de Autos -->
    <section class="gallery-section container">
        <h2 class="gallery-title">Autos Premium</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="card">
                    <img src="./images/carro1.png" class="card-img-top" alt="Toyota Supra">
                    <div class="card-body">
                        <h5 class="card-title">Toyota Supra</h5>
                        <p class="card-text">Deportivo, potente y elegante.</p>
                        <a href="#" class="btn btn-card">Alquilar</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5">
                <div class="card">
                    <img src="./images/carro1.png" class="card-img-top" alt="Tesla Model S">
                    <div class="card-body">
                        <h5 class="card-title">Tesla Model S</h5>
                        <p class="card-text">Eléctrico y moderno, para el futuro.</p>
                        <a href="#" class="btn btn-card">Alquilar</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5">
                <div class="card">
                    <img src="./images/carro1.png" class="card-img-top" alt="BMW M4">
                    <div class="card-body">
                        <h5 class="card-title">BMW M4</h5>
                        <p class="card-text">Lujo y velocidad en su máxima expresión.</p>
                        <a href="#" class="btn btn-card">Alquilar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre Nosotros</h5>
                    <p>Ofrecemos una experiencia de alquiler de autos premium, con un servicio de calidad y vehículos de lujo para satisfacer tus necesidades.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces Rápidos</h5>
                    <p><a href="#">Política de Privacidad</a></p>
                    <p><a href="#">Términos y Condiciones</a></p>
                    <p><a href="#">Contáctanos</a></p>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2024 Alquiler de Autos Premium. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
