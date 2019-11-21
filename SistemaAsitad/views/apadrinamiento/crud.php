<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Apadrinamiento</title>
</head>

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
      <form action="<?= baseUrl ?>apadrinamiento/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="fechaInicial">Fecha inicial</label>
            <input id="fechaInicial" name="fechaInicial" class="form-control" type="date">
          </div>
          <div class="form-group col-6">
              <span>abuelito</span><br>
              <select class ="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
                  <option>elije..</option>
                  <?php $abue= AbuelitoController::getAll(); ?>
                  <?php while ($abu= $abue->fetch_object()): ?>
                      <option value ="<?= $abu->id;?>"><?= $abu->nombre; ?></option>
                    <?php endwhile; ?>
                </select>
          </div>
          <div class="form-group col-6">
            <span>abuelito</span><br>
            <select class ="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
                <option>elije..</option>
                <?php $abue= AbuelitoController::getAll(); ?>
                <?php while ($abu= $abue->fetch_object()): ?>
                    <option value ="<?= $abu->id;?>"><?= $abu->nombre; ?></option>
                <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
              <
            <label for="usuario_idUsuario">usuario_idUsuario Actividad</label>
            <input id="usuario_idUsuario" name="usuario_idUsuario" class="form-control" type="number">
          </div>
          <div class="col-6">
            <span>Tipo Actividad</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTipoActividad; ?>"><?= $t->tipoActividad; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-6">
            <span>Usuarios</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php $users = UserController::getAll(); ?>
              <?php while ($u = $users->fetch_object()) : ?>
                <option value="<?= $u->id; ?>"><?= $u->nombre; ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="col-6">
            <span>Abuelitos</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php $users = UserController::getAll(); ?>
              <?php while ($u = $users->fetch_object()) : ?>
                <option value="<?= $u->id; ?>"><?= $u->nombre; ?></option>
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
            <label for="fecha">fecha Actividad </label>
            <input id="fecha" name="fecha" class="form-control" type="text" value="<?= $r->fechaActividad ?>">
          </div>
          <div class="form-group col-6">
            <label for="nombre">nombre Actividad</label>
            <input id="nombre" name="nombre" class="form-control" type="text" value="<?= $r->nombreActividad?>">
          </div>
          <div class="form-group col-6">
            <label for="hora">hora Actividad </label>
            <textarea class="form-control" id="hora" name="hora"><?= $r->horaActividad ?></textarea>
          </div>
         
          <div class="col-6">
            <span>Tipo Actividad</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="tipo" id="tipo">
              <option>Elija...</option>
              <?php while ($t = $tipos->fetch_object()) : ?>
                <option value="<?= $t->idTiopoActividad; ?>"><?= $t->tipoActividad; ?></option>
              <?php endwhile; ?>
            </select>
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
        <?php while ($med = $actividad->fetch_object()) : ?>
          <tr>
            <td><?= $med->fechaActividad ?></td>
            <td><?= $med->nombreActividad ?></td>
            <td><?= $med->horaActividad?></td>
            <td><?= $med->tipoActividad ?></td>
            <td><?= $med->usuario_idUsuario ?></td>
            <td><?= $med->abuelito_idAbuelito ?></td>
            <td>
              <a href="<?= baseUrl ?>actividad/eliminar&id=<?= $med->idActividad ?>" class="btn btn-danger">Eliminar</a>
              <a href="<?= baseUrl ?>actividad/gestion&id=<?= $med->idActividad ?>" class="btn btn-info">Editar</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>