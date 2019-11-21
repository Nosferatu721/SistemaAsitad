<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Certificado</title>
</head>

<!-- El <body> solo se abre, el </body> esta en el FOOTER -->

<body>

  <!-- Aqui va el Contenido de la Pagina -->
  <div class="container mt-4">
    <?php require_once 'views/layout/banner.php'; ?>

    <?php if (isset($_SESSION['registrado'])) : ?>
      <h5 class="text-success text-center">Registrado</h5>
    <?php elseif (isset($_SESSION['actualizado'])) : ?>
      <h5 class="text-info text-center">Actualizado</h5>
    <?php elseif (isset($_SESSION['eliminado'])) : ?>
      <h5 class="text-warning text-center">Eliminado</h5>
    <?php else : ?>
      <hr class="border-dark">
    <?php endif ?>
    <?= Utils::deleteSession('registrado') ?>
    <?= Utils::deleteSession('actualizado') ?>
    <?= Utils::deleteSession('eliminado') ?>

    <!-- Formulario De Registro -->
    <?php if (!isset($_GET['id'])) : ?>
      <form action="<?= baseUrl ?>certificado/registrar" method="POST">
        <div class="row">

        <div class="col-6">
            <span>Tipo Certificado</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idtipoCertificado; ?>"><?= $t->tipoCertificado; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>
          <div class="form-group col-6">
            <label for="hora">horaCertificado</label>
            <input id="hora" name="hora" class="form-control" type="number">
          </div>
         
          
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>certificado/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
        <div class="col-6">
            <span>Tipo Certificado</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idtipoCertificado; ?>"><?= $t->tipoCertificado; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>
          <div class="form-group col-6">
            <label for="horaCertificado">horaCertificado</label>
            <input id="hora" name="hora" class="form-control" type="number">
          </div>
          
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Actualizar">
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table class="table">
      <thead>
        <tr>
          <th scope="col">tipoCertificado</th>
          <th scope="col">Descripcion</th>
          <th scope="col">horaCertificado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($med = $medicamentos->fetch_object()) : ?>
          <tr>
            <td><?= $med->tipoCertificado ?></td>
            <td><?= $med->descripcion ?></td>
            <td><?= $med->horaCertificado ?></td>
            <td>
              <a href="<?= baseUrl ?>certificado/eliminar&id=<?= $med->idCertificado ?>" class="btn btn-danger">Eliminar</a>
              <a href="<?= baseUrl ?>certificado/gestion&id=<?= $med->idCertificado ?>" class="btn btn-info">Editar</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>