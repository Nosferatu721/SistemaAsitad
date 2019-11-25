<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<title>Asitad - Donacion</title>
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
      <form action="<?= baseUrl ?>donacion/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="valor">valor Donacion</label>
            <input id="valor" name="valor" class="form-control" type="number">
          </div>
          <div class="form-group col-6">
            <label for="fecha">fecha Donacion</label>
            <input id="fecha" name="fecha" class="form-control" type="date">
          </div>
          <div class="col-6">
            <span>Tipo Donacion</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <option>Dinero</option>
              <option>Ropa</option>
              <option>Alimentos</option>
              <option>Aseo personal</option>
            </select>
          </div>
          <div class="col-6">
            <span>Usuarios</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="usuario_idUsuario" id="usuario_idUsuario">
              <option>Elija...</option>
              <?php $users = UserController::getAll(); ?>
              <?php while ($u = $users->fetch_object()) : ?>
                <option value="<?= $u->idUsuario; ?>"><?= $u->nombre; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <span>abuelito</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
              <option>elije..</option>
              <?php $abue = AbuelitoController::getAll(); ?>
              <?php while ($abu = $abue->fetch_object()) : ?>
                <option value="<?= $abu->idAbuelito; ?>"><?= $abu->nombreAbuelito; ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group col-6">
            <label for="descripcion">descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>
          </select>
        </div>
        <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar">
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>donacion/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="valor">Valor Donacion</label>
            <input id="valor" name="valor" class="form-control" type="number" value="<?= $r->valorDonacion ?>">
          </div>

          <div class="form-group col-6">
            <label for="fecha">Fecha Donacion</label>
            <input id="fecha" name="fecha" class="form-control" type="date">
          </div>
          <div class="col-6">
            <span>Tipo Donacion</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <option>Dinero</option>
              <option>Ropa</option>
              <option>Alimentos</option>
              <option>Aseo personal</option>
            </select>
          </div>
          <div class="col-6">
            <span>Usuarios</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="usuario_idUsuario" id="usuario_idUsuario">
              <option>Elija...</option>
              <?php $users = UserController::getAll(); ?>
              <?php while ($u = $users->fetch_object()) : ?>
                <option value="<?= $u->idUsuario; ?>"><?= $u->nombre; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <span>abuelito</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
              <option>elije..</option>
              <?php $abue = AbuelitoController::getAll(); ?>
              <?php while ($abu = $abue->fetch_object()) : ?>
                <option value="<?= $abu->idAbuelito; ?>"><?= $abu->nombreAbuelito; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
          </div>

          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Actualizar">
        </div>
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Valor</th>
          <th scope="col">Fecha</th>
          <th scope="col">Tipo</th>
          <th scope="col">Usuario</th>
          <th scope="col">Abuelito</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php $d = DonacionController::GETALL(); ?>
        <?php while ($don = $d->fetch_object()) : ?>
          <tr>
            <td><?= $don->valorDonacion ?></td>
            <td><?= $don->fecha ?></td>
            <td><?= $don->tipoDonacion ?></td>
            <td><?= $don->usuario_idUsuario ?></td>
            <td><?= $don->nombreAbuelito ?></td>
            <td><?= $don->descripcionDonacion ?></td>
            <td>
              <a href="<?= baseUrl ?>donacion/eliminar&id=<?= $don->idDonacion ?>" class="btn btn-danger">Eliminar</a>
              <a href="<?= baseUrl ?>donacion/gestion&id=<?= $don->idDonacion ?>" class="btn btn-info">Editar</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-center mb-2">
      <a href="<?= baseUrl; ?>donacion/pdf" target="blank" class="btn btn-danger">PDF</a>
    </div>

    <hr>

    <div id="container"></div>


    <script type="text/javascript">
      $(function() {
        $('#container2').highcharts({
          chart: {
            type: 'cylinder',
            options3d: {
              enabled: true,
              alpha: 15,
              beta: 15,
              depth: 50,
              viewDistance: 25
            }
          },
          title: {
            text: 'Highcharts Cylinder Chart'
          },
          plotOptions: {
            series: {
              depth: 25,
              colorByPoint: true
            }
          },
          series: [{
            data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
            name: 'Cylinders',
            showInLegend: false
          }]
        })
      });
    </script>

  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>

</body>

</html>