<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
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
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar" id="send">
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
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Actualizar" id="send">
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
        <?php $o = MedicamentoController::GETALL(); ?>
        <?php while ($med = $o->fetch_object()) : ?>
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

    <div class="d-flex justify-content-center mb-2">
      <a href="<?= baseUrl; ?>medicamento/pdf" target="blank" class="btn btn-danger">PDF</a>
    </div>

    <hr>

    <div id="container2" style="height: 400px" class="my-3"></div>

    <script type="text/javascript">
      $(function() {
        $('#container2').highcharts({
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
          },
          title: {
            text: 'Medicamentos'
          },
          tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                enabled: true,
                style: {
                  color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
              }
            }
          },
          series: [{
            type: 'pie',
            name: 'Cantidad',
            data: [
              <?php $o = MedicamentoController::GETALL(); ?>
              <?php
              foreach ($o as $medicamentos) {
                ?>['<?= $medicamentos['nombreMedicamento'] ?>', <?= $medicamentos['unidades'] ?>],
              <?php
              }
              ?>
            ]
          }]
        });
      });
    </script>

  </div>

  <script src="<?= baseUrl ?>assets/js/validarMed.js"></script>
  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>


</body>

</html>