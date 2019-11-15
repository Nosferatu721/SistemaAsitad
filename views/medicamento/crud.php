<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Medicamentos</title>
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
      <form action="<?= baseUrl ?>medicamento/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre">Nombre Medicamento</label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>
          <div class="form-group col-6">
            <label for="unidades">Unidades</label>
            <input id="unidades" name="unidades" class="form-control" type="number">
          </div>
          <div class="col-6">
            <span>Tipo Medicamento</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoMedicamento; ?>"><?= $t->tipoMedicamento; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="laboratorio">Laboratorio</label>
            <input id="laboratorio" name="laboratorio" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="fecha">Fecha Vencimiento</label>
            <input id="fecha" name="fecha" class="form-control" type="date">
          </div>
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>medicamento/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre">Nombre Medicamento</label>
            <input id="nombre" name="nombre" class="form-control" type="text" value="<?= $r->nombreMedicamento ?>">
          </div>
          <div class="form-group col-6">
            <label for="estado">Estado</label>
            <input id="estado" name="estado" class="form-control" type="text" value="<?= $r->estado ?>">
          </div>
          <div class="form-group col-6">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion"><?= $r->descripcionMedicamento ?></textarea>
          </div>
          <div class="form-group col-6">
            <label for="unidades">Unidades</label>
            <input id="unidades" name="unidades" class="form-control" type="number" value="<?= $r->unidades ?>">
          </div>
          <div class="col-6">
            <span>Tipo Medicamento</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoMedicamento; ?>"><?= $t->tipoMedicamento; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="laboratorio">Laboratorio</label>
            <input id="laboratorio" name="laboratorio" class="form-control" type="text" value="<?= $r->laboratorio ?>">
          </div>
          <div class="form-group col-6">
            <label for="fecha">Fecha Vencimiento</label>
            <input id="fecha" name="fecha" class="form-control" type="date" value="<?= $r->fechaVencimiento ?>">
          </div>
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Actualizar">
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Unidades</th>
          <th scope="col">Estado</th>
          <th scope="col">Tipo</th>
          <th scope="col">Laboratorio</th>
          <th scope="col">Fecha</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($med = $medicamentos->fetch_object()) : ?>
          <tr>
            <td><?= $med->nombreMedicamento ?></td>
            <td><?= $med->descripcionMedicamento ?></td>
            <td><?= $med->unidades ?></td>
            <td><?= $med->estado ?></td>
            <td><?= $med->tipoMedicamento ?></td>
            <td><?= $med->nombreMedicamento ?></td>
            <td><?= $med->fechaVencimiento ?></td>
            <td>
              <a href="<?= baseUrl ?>medicamento/eliminar&id=<?= $med->idMedicamentos ?>" class="btn btn-danger">Eliminar</a>
              <a href="<?= baseUrl ?>medicamento/gestion&id=<?= $med->idMedicamentos ?>" class="btn btn-info">Editar</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>