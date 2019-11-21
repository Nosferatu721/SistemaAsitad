<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Eventos</title>
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
      <form action="<?= baseUrl ?>evento/registrar" method="POST">
      <div class="row">
        <div class="col-6">
          <span>Tipo Evento</span><br>
          <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
            <option>Elija...</option>
            <?php while ($t = $tipos->fetch_object()) : ?>
              <option value="<?= $t->idTipoEvento; ?>"><?= $t->tipoEvento; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-group col-6">
          <label for="fecha">Fecha Evento</label>
          <input id="fecha" name="fecha" class="form-control" type="date">
        </div>
        <div class="form-group col-6">
          <label for="descripcion">Descripcion</label>
          <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="form-group col-6">
          <label for="descripcion">Estado</label>
          <textarea class="form-control" id="estado" name="estado"></textarea>
        </div>
      </div>
        <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar">
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>evento/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="col-6">
          <span>Tipo Evento</span><br>
          <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
            <option>Elija...</option>
            <?php while ($t = $tipos->fetch_object()) : ?>
              <option value="<?= $t->idTipoEvento; ?>"><?= $t->tipoEvento; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-group col-6">
          <label for="fecha">Fecha Evento</label>
          <input id="fecha" name="fecha" class="form-control" type="date" value="<?= $r->fechaVencimiento ?>">
        </div>
        <div class="form-group col-6">
          <label for="estado">Estado</label>
          <input id="estado" name="estado" class="form-control" type="text" value="<?= $r->estado ?>">
        </div>
        <div class="form-group col-6">
          <label for="descripcion">Descripcion</label>
          <textarea class="form-control" id="descripcion" name="descripcion"><?= $r->descripcionMedicamento ?></textarea>
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Tipo</th>
          <th scope="col">Fecha</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Estado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($eve = $eventos->fetch_object()) : ?>
          <tr>
            <td><?= $eve->tipoEvento ?></td>
            <td><?= $eve->fechaEvento ?></td>
            <td><?= $eve->descripcionEventos ?></td>
            <td><?= $eve->estado ?></td>
            <td>
              <a href="<?= baseUrl ?>evento/eliminar&id=<?= $eve->idEventos ?>" class="btn btn-danger">Eliminar</a>
              <a href="<?= baseUrl ?>evento/gestion&id=<?= $eve->idEventos ?>" class="btn btn-info">Editar</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>