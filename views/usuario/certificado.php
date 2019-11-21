<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Usuario</title>
</head>

<!-- El <body> solo se abre, el </body> esta en el FOOTER -->

<body>

  <!-- Aqui va el Contenido de la Pagina -->
  <div class="container mt-4">
    <?php require_once 'views/layout/banner.php'; ?>

    <!-- Formulario De Registro -->
    <form action="<?= baseUrl ?>user/certPDF" class="mt-4" method="POST">
      <div class="row d-flex align-items-center">
        <div class="col-6">
          <span>Usuario</span><br>
          <?php $us = UserController::getAll(); ?>
          <select class="custom-select my-1 mr-sm-2" name="user" id="user">
            <option>Elija...</option>
            <?php while ($u = $us->fetch_object()) : ?>
              <option value="<?= $u->idUsuario; ?>"><?= $u->nombre; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-group col-6">
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3s" value="Generar Certificado">
        </div>
      </div>
    </form>
  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>