<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Pass</title>
</head>

<!-- El <body> solo se abre, el </body> esta en el FOOTER -->

<body>

  <!-- Aqui va el Contenido de la Pagina -->
  <div class="container mt-4">
    <div class="row d-flex justify-content-center">
      <form action="<?= baseUrl ?>user/RPass" method="POST" class="col-md-6 col-sm-12">
        <h1 class="text-center">Recuperar</h1>
        <hr class="border-primary">
        <div class="form-group">
          <label for="correo">Correo</label>
          <input id="correo" name="correo" class="form-control" type="email">
        </div>
        <div class="text-center">
          <input type="submit" class="btn btn-outline-info col-6" value="Recuperar">
          <hr>
          <a href="<?= baseUrl ?>user/reLogear" class="text-danger">Volver</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>