<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Usuario</title>
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
      <form action="<?= baseUrl ?>user/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="apellido">Apellido</label>
            <input id="apellido" name="apellido" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="correo">Correo</label>
            <input id="correo" name="correo" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="contrasena">Contraseña</label>
            <input id="contrasena" name="contrasena" class="form-control" type="text">
          </div>
          <div class="col-6">
            <span>Rol</span><br>
            <select class="custom-select mr-sm-2 mt-1" name="rol" id="rol">
              <option>Elija...</option>
              <?php while ($r = $rol->fetch_object()) : ?>
                <option value="<?= $r->idRol; ?>"><?= $r->tipoRol; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3s" value="Registrarme">
            
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
            <input id="nombreActividad" name="nombreActividad" class="form-control" type="text" value="<?= $r->nombreActividad ?>">
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
            <select class="custom-select mr-sm-2 mt-1" name="abuelito_idAbuelito" id="abuelito_idAbuelito">
              <option>elije..</option>
              <?php $abue = AbuelitoController::getAll(); ?>
              <?php while ($abu = $abue->fetch_object()) : ?>
                <option value="<?= $abu->idAbuelito; ?>"><?= $abu->nombreAbuelito; ?></option>
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
          <th scope="col">Nombre Usuario</th>
          <th scope="col">Apellido Usuario</th>
          <th scope="col">Correo</th>
          <th scope="col">Rol</th>
          <th scope="col">Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($u = $use->fetch_object()) : ?>
          <tr>
            <td><?= $u->nombre ?></td>
            <td><?= $u->apellido ?></td>
            <td><?= $u->email ?></td>
            <td><?= $u->tipoRol ?></td>
            
            <td>
            <a href="<?= baseUrl ?>actividad/gestion&id=<?= $ac->id ?>" class="btn btn-info">Editar</a>
              <a href="<?= baseUrl; ?>user/eliminar&id=<?= $u->idUsuario; ?>" class="btn btn-outline-<?= $u->estado == 'Activo' ? 'danger' : ($u->estado == 'Inactivo' ? 'success' : ''); ?> btn-sm">Actualizar <i class="fas fa-exchange-alt"></i></a> 
             
              <div class="modal fade modal<?= $user->idusuarios ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><?= confirmar ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?= $a->estado == 'Activo' ? inactivar : ($a->estado == 'Inactivo' ? activar : ''); ?> <?= pregunta ?>
                      </div>
                      <div class="modal-footer p-2">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"><?= cancelar ?></button>
                      </div>
                    </div>
                  </div>
                </div>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

  </div>

  <!-- Se llama el footer -->
  <?php require_once 'views/layout/footer.php'; ?>