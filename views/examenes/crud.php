<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Examenes Medicos</title>
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
      <form action="<?= baseUrl ?>examenes/registrar" method="POST" enctype="multipart/form-data" >
        <div class="row">
        <div class="form-group col-6">
            <label for="fecha">Fecha </label>
            <input id="fecha" name="fecha" class="form-control" type="date">
          </div>
         
          <div class="form-group col-6">
            <label for="nombre">nombre medicamento</label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>
          
          <div class="form-group col-6">
            <label for="descripcion">descricion</label>
            <input id="descripcion" name="descripcion" class="form-control" type="text">
          </div>
          <div class="form-label-group col-12 col-lg-6 py-2">
          <label>Seleccionar Archivo - Word <i class="fas fa-file-word"></i> - PDF <i class="fas fa-file-pdf"></i></label>
          <input type="file" class="form-control-file btn btn-outline-dark" id="archivo" name="archivo">
        </div>
          
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>examenes/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
          <div class="col-6">
            <span>Enfermedad</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idEnfermedad; ?>"><?= $t->enfermedad; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-6">
            <span>Medicamentos</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idMedicamento; ?>"><?= $t->idTipoMedicamento; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          
          <div class="form-group col-6">
            <label for="fecha">Fecha </label>
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
          <th scope="col">Fecha</th>
          <th scope="col">nombre de examen</th>
          <th scope="col">descripcion de examen</th>
          <th scope="col">Documento</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($exa = $examenes->fetch_object()) : ?>
          <tr>
            <td><?= $exa->fechaExamenesMedicos ?></td>
            <td><?= $exa->nombreExamenesMedico ?></td>
            <td><?= $exa->descripcionExamenMedico?></td>
            <td><?= $exa->documentos?></td>
          <td>
              <a href="<?= baseUrl ?>examenes/eliminar&id=<?= $exa->idExamenesMedicos ?>" class="btn btn-danger">Eliminar</a>
              <a href="<?= baseUrl ?>examenes/gestion&id=<?= $exa->idExa ?>" class="btn btn-info">Editar</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>