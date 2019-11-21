<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Registrarme</title>
</head>

<!-- El <body> solo se abre, el </body> esta en el FOOTER -->

<body>

  <!-- Aqui va el Contenido de la Pagina -->
  <div class="container mt-4">
    <div class="row d-flex justify-content-center">
      <form action="<?= baseUrl ?>user/registrar" method="POST" class="col-md-6 col-sm-12">
        <h1 class="text-center">Registro</h1>
        <hr class="border-success">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" class="form-control" type="text">
        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input id="apellido" name="apellido" class="form-control" type="text">
        </div>
        <div class="form-group">
          <label for="correo">Correo</label>
          <input id="correo" name="correo" class="form-control" type="email">
        </div>
        <div class="form-group">
          <label for="contraseña">Contraseña</label>
          <input id="contraseña" name="contraseña" class="form-control" type="text">
        </div>
        <div class="text-center">
          <input type="submit" class="btn btn-outline-info col-6" value="Registrarme">
          <hr>
          <a href="<?= baseUrl ?>user/login" class="text-primary">Ingresar</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>