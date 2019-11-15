<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Actividad</title>
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
      <form action="<?= baseUrl ?>actividad/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="fechaActividad">Fecha Actividad</label>
            <input id="fechaActividad" name="fechaActividad" class="form-control" type="date">
          </div>
          <div class="form-group col-6">
            <label for="nombreActividad"> nombre Actividad</label>
            <textarea class="form-control" id="nombreActividad" name=nombreActividad></textarea>
          </div>
          <div class="form-group col-6">
            <label for="horaActividad">Hora Actividad</label>
            <input id="horaActividad" name="horaActividad" class="form-control" type="number">
          </div>
          <div class="col-6">
            <span>Tipo Actividad</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipoActividad" id="tipoActividad">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoActividad; ?>"><?= $t->tipoActividad; ?></option>
              <?php endwhile; ?>
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
            <select class ="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
                <option>elije..</option>
                <?php $abuel= AbuelitoController::getAll(); ?>
                <?php while ($a= $abuel->fetch_object()): ?>
                    <option value ="<?= $a->idAbuelito;?>"><?= $a->nombreAbuelito; ?></option>
                <?php endwhile; ?>
            </select>
          </div>
          
          <div class="form-group col-6">
            
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>actividad/actualizar&id=<?= $_GET['id'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="fechaActividad">fecha Actividad </label>
            <input id="fechaActividad" name="fechaActividad" class="form-control" type="date" value="<?= $r->fechaActividad ?>">
          </div>
          <div class="form-group col-6">
            <label for="nombreActividad">nombre Actividad</label>
            <input id="nombreActividad" name="nombreActividad" class="form-control" type="text" value="<?= $r->nombreActividad?>">
          </div>
          <div class="form-group col-6">
            <label for="horaActividad">hora Actividad </label>
            <textarea class="form-control" id="horaActividad" name="horaActividad"><?= $r->horaActividad ?></textarea>
          </div>
         
          <div class="col-6">
            <span>Tipo Actividad</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="Tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoActividad; ?>"><?= $t->tipoActividad; ?></option>
              <?php endwhile; ?>
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
            <select class ="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
                <option>elije..</option>
                <?php $abue= AbuelitoController::getAll(); ?>
                <?php while ($abu= $abue->fetch_object()): ?>
                    <option value ="<?= $abu->idAbuelito;?>"><?= $abu->nombreAbuelito; ?></option>
                <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group col-6">
            
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="actualizar">
        </div>
          
      </form>
    <?php endif; ?>

    <!-- Tabla -->

    <table class="table">
      <thead>
        <tr>
          <th scope="col">fechaActividad</th>
          <th scope="col">nombreActividad</th>
          <th scope="col">horaActividad</th>
          <th scope="col">TipoActividad</th>
          <th scope="col">Usuario</th>
          <th scope="col">Abuelito</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($ac = $actividad->fetch_object()) : ?>
          <tr>
            <td><?= $ac->fechaActividad ?></td>
            <td><?= $ac->nombreActividad ?></td>
            <td><?= $ac->horaActividad?></td>
            <td><?= $ac->tipoActividad ?></td>
            <td><?= $ac->nombre ?></td>
            <td><?= $ac->nombreAbuelito ?></td>
            <td>
              
              <a href="<?= baseUrl ?>actividad/eliminar&id=<?= $ac->id ?>" class="btn btn-danger">Eliminar</a>
              <a href="<?= baseUrl ?>actividad/gestion&id=<?= $ac->id ?>" class="btn btn-info">Editar</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>