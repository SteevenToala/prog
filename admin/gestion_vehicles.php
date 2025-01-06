<?php
session_start();

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_admin.css">
    <link rel="stylesheet" href="./home_section/styles/menuA.css">
    <link rel="stylesheet" href="./home_section/styles/modeladdVehicle.css">
    
    <style>
        .eliminarR {
            color: black;
        }

        .xd {
            display: flex;
            width: 90%;
            height: 90%;
            background-color: aliceblue;
            border-radius: 20px;
            padding: 10px;
            overflow-x: scroll;
            margin: 0 auto;
        }

        /* General */
        .sidebar {
            transition: transform 0.3s ease-in-out;
            height: 100vh;
            position: fixed;
            z-index: 1030;
            top: 0;
            left: 0;
            width: 250px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        /* Ocultar el menú por defecto en pantallas pequeñas */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            /* Mostrar el menú cuando el checkbox esté marcado */
            #menu-toggle:checked~.sidebar {
                transform: translateX(0);
            }

            /* Ajustes al encabezado del menú */
            .sidebar h4 {
                font-size: 1.2rem;
            }

            .nav-item .nav-link {
                font-size: 1rem;
            }
        }

        /* Botón para alternar el menú */
        .sidebar-toggler-label {
            display: none;
            position: fixed;

            background-color: #ffffff;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            font-size: 1.5rem;
            z-index: 1040;
            cursor: pointer;
        }

        .sidebar-toggler-label i {
            color: #333;
        }

        /* Mostrar el botón solo en pantallas pequeñas */
        @media (max-width: 768px) {
            .sidebar-toggler-label {
                display: inline-block;
            }
        }
    </style>
</head>

<body>

    <?php
    include './home_section/modals/modal_editVehicle.html';
    include './home_section/modals/modal_addVehicle.html';

    ?>


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php
            include './home_section/scripts/menu.php';
            ?>

            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content" style="width:100%">            

                <div class="xd">
                    <!-- Sección de Listar Vehiculos -->
                    <?php include './home_section/listVehicle.php'; ?>
                </div>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./home_section/js/addVehicle.js"></script>
    <script src="./home_section/js/editVehicle.js"></script>
    <script src="./home_section/js/removeVehicle.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const modelosPorMarca = {
        Toyota: ["Corolla", "Camry", "RAV4", "Hilux", "Land Cruiser", "Yaris", "Fortuner", "Supra"],
        Nissan: ["Sentra", "Altima", "Navara", "X-Trail", "Versa", "Patrol", "Kicks", "Leaf"],
        Ford: ["Fiesta", "Focus", "Explorer", "Ranger", "Escape", "Edge", "Bronco", "Mustang"],
        Chevrolet: ["Spark", "Cruze", "Trailblazer", "Silverado", "Equinox", "Suburban", "Malibu", "Traverse"],
        Honda: ["Civic", "Accord", "CR-V", "Pilot", "Fit", "Odyssey", "HR-V", "Passport"],
        BMW: ["Serie 3", "Serie 5", "X1", "X3", "X5", "Serie 7", "M3", "Z4"],
        Mercedes_Benz: ["Clase A", "Clase C", "Clase E", "GLE", "GLC", "GLA", "S-Class", "AMG GT"],
        Audi: ["A3", "A4", "A6", "Q3", "Q5", "Q7", "R8", "e-tron"],
        Hyundai: ["Elantra", "Tucson", "Santa Fe", "Kona", "Sonata", "Accent", "Venue", "Ioniq"],
        Kia: ["Rio", "Sportage", "Sorento", "Seltos", "Telluride", "Forte", "Stinger", "Niro"],
        Volkswagen: ["Jetta", "Passat", "Tiguan", "Polo", "Golf", "Atlas", "Arteon", "Beetle"],
        Mazda: ["Mazda 3", "Mazda 6", "CX-3", "CX-5", "CX-9", "MX-5", "BT-50", "RX-8"],
        Subaru: ["Impreza", "Forester", "Outback", "WRX", "Legacy", "Ascent", "BRZ", "Crosstrek"],
        Tesla: ["Model S", "Model 3", "Model X", "Model Y", "Cybertruck", "Roadster"],
        Jeep: ["Wrangler", "Cherokee", "Grand Cherokee", "Compass", "Renegade", "Gladiator"],
        Mitsubishi: ["Lancer", "Outlander", "Pajero", "Eclipse Cross", "Mirage", "Montero Sport"],
        Land_Rover: ["Defender", "Discovery", "Range Rover Evoque", "Range Rover Sport", "Range Rover Velar"],
        Volvo: ["XC40", "XC60", "XC90", "S60", "S90", "V60", "V90"],
        Suzuki: ["Swift", "Vitara", "Jimny", "Celerio", "Baleno", "Ignis", "S-Cross"],
        Peugeot: ["208", "2008", "3008", "5008", "308", "508", "Rifter", "Traveller"],
        Renault: ["Clio", "Duster", "Captur", "Koleos", "Sandero", "Logan", "Megane", "Talisman"],
        Fiat: ["500", "Panda", "Tipo", "Toro", "Ducato", "Argo", "Strada", "Cronos"]
    };

    const marcaSelect = document.getElementById('marca');
    const modeloSelect = document.getElementById('modelo');

    // Agregar marcas al selector
    for (const marca in modelosPorMarca) {
        const option = document.createElement('option');
        option.value = marca;
        option.textContent = marca.replace("_", " "); // Reemplaza guiones bajos por espacios
        marcaSelect.appendChild(option);
    }

    // Escuchar el cambio en el selector de marcas
    marcaSelect.addEventListener('change', () => {
        const marcaSeleccionada = marcaSelect.value;

        // Limpiar los modelos existentes
        modeloSelect.innerHTML = '<option value="" disabled selected>Seleccione un modelo</option>';

        // Agregar los modelos correspondientes a la marca seleccionada
        if (modelosPorMarca[marcaSeleccionada]) {
            modelosPorMarca[marcaSeleccionada].forEach(modelo => {
                const option = document.createElement('option');
                option.value = modelo;
                option.textContent = modelo;
                modeloSelect.appendChild(option);
            });
        }
    });
});

    </script>
   

<script>
    document.getElementById('imagen').addEventListener('change', function(event) {
        const input = event.target;
        const preview = document.getElementById('previewImagen');

        // Verifica que se haya seleccionado un archivo
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            // Carga la imagen en el elemento <img>
            reader.onload = function(e) {
                preview.src = e.target.result; // Asigna la imagen cargada
                preview.classList.remove('d-none'); // Muestra la imagen
            };

            // Lee el archivo seleccionado
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = ''; // Limpia la imagen si no hay selección
            preview.classList.add('d-none'); // Oculta la imagen
        }
    });
</script>


<script>
    document.getElementById('matricula').addEventListener('input', function (e) {
        let value = e.target.value.toUpperCase(); // Convertir todo a mayúsculas

        // Filtrar las letras y los números por separado
        let letters = value.replace(/[^A-Z]/g, ''); // Solo letras A-Z
        let numbers = value.replace(/[^0-9]/g, ''); // Solo números 0-9

        // Limitar a 3 letras antes del guion
        letters = letters.slice(0, 3);

        // Limitar a 3 números después del guion
        numbers = numbers.slice(0, 3);

        // Combinar las letras y los números con el guion si es necesario
        if (letters.length === 3 && numbers.length === 0) {
            value = letters + '-';
        } else {
            value = letters + (numbers ? '-' + numbers : ''); // Si hay números, se agrega el guion
        }

        // Actualizar el valor del input
        e.target.value = value;
    });
</script>
<script>
    document.getElementById('editMatricula').addEventListener('input', function (e) {
        let value = e.target.value.toUpperCase(); // Convertir todo a mayúsculas

        // Filtrar las letras y los números por separado
        let letters = value.replace(/[^A-Z]/g, ''); // Solo letras A-Z
        let numbers = value.replace(/[^0-9]/g, ''); // Solo números 0-9

        // Limitar a 3 letras antes del guion
        letters = letters.slice(0, 3);

        // Limitar a 3 números después del guion
        numbers = numbers.slice(0, 3);

        // Combinar las letras y los números con el guion si es necesario
        if (letters.length === 3 && numbers.length === 0) {
            value = letters + '-';
        } else {
            value = letters + (numbers ? '-' + numbers : ''); // Si hay números, se agrega el guion
        }

        // Actualizar el valor del input
        e.target.value = value;
    });
</script>

</body>

</html>