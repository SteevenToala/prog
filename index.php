<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/index.css">
  <title>Home</title>
</head>

<body>
  <?php
  include './util/menuindex.php';
  ?>


  <div class="container mt-5">
    <div class="row">
      <!-- Cuadro 1 -->
      <div class="col-md-4">
        <div class="card">
          <img src="./images/background.jpg" class="card-img-top" alt="imagen blog 1">
          <div class="card-body">
            <h5 class="card-title">Título del Post 1</h5>
            <p class="card-text">Una breve descripción o resumen del contenido del post.</p>
            <a href="#" class="btn btn-primary">Leer más</a>
          </div>
        </div>
      </div>

      <!-- Cuadro 2 -->
      <div class="col-md-4">
        <div class="card">
          <img src="./images/background.jpg" class="card-img-top" alt="imagen blog 2">
          <div class="card-body">
            <h5 class="card-title">Título del Post 2</h5>
            <p class="card-text">Una breve descripción o resumen del contenido del post.</p>
            <a href="#" class="btn btn-primary">Leer más</a>
          </div>
        </div>
      </div>

      <!-- Cuadro 3 -->
      <div class="col-md-4">
        <div class="card">
          <img src="./images/background.jpg" class="card-img-top" alt="imagen blog 3">
          <div class="card-body">
            <h5 class="card-title">Título del Post 3</h5>
            <p class="card-text">Una breve descripción o resumen del contenido del post.</p>
            <a href="#" class="btn btn-primary">Leer más</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>