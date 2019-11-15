<!-- Se llama el Header -->
<?php require_once 'views/layout/header.php'; ?>
<title>Asitad - Abuelitos</title>
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
    <?php if (!isset($_GET['idAbuelito'])) : ?>
      <form action="<?= baseUrl ?>abuelito/registrar" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre">nombre </label>
            <input id="nombre" name="nombre" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="apellido">apellido </label>
            <input id="apellido" name="apellido" class="form-control" type="text">
          </div>
          <div class="form-group col-6">
            <label for="fechaNacimiento">fecha nacimiento</label>
            <input id="fechaNacimiento" name="fechaNacimiento" class="form-control" type="date">
          </div>

          <div class="form-group col-6">
            <label for="nececidades">Necesidad</label>
            <select class="custom-select mr-sm-2 mt-1" name="necesidades" id="necesidades">
              <option>Elija...</option>
              <option>Dinero</option>
              <option>Ropa</option>
              <option>Alimentos</option>
              <option>Aseo personal</option>
            </select>
          </div>


          <div class="form-group col-6">
            <label for="examenesMedicos">Examenes medicos</label>
            <select class="custom-select mr-sm-2 mt-1" name="examenesMedicos" id="examenesMedicos">
              <option>Elija...</option>
              <?php while ($t = $examenes->fetch_object()) : ?>
                <option value="<?= $t->idExamenesMedicos; ?>"><?= $t->nombreExamenesMedico; ?>-<?= $t->fechaExamenesMedicos; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="estadoSalud">Estado salud</label>
            <select class="custom-select mr-sm-2 mt-1" name="estadoSalud" id="estadoSalud">
              <option>cuidado grave</option>
              <option>cuidado medio</option>
              <option>cuidado bajo</option>
            </select>
          </div>
          <input type="submit" class="btn btn-primary btn-sm btn-block col-6 offset-3 mb-3" value="Registrar">
        </div>
      </form>

    <?php else : ?>
      <!-- Formulario para Editar -->
      <form action="<?= baseUrl ?>abuelito/actualizar&idAbuelito=<?= $_GET['idAbuelito'] ?>" method="POST">
        <div class="row">
          <div class="form-group col-6">
            <label for="nombre">nombre</label>
            <input id="nombre" name="nombre" class="form-control" type="text" value="<?= $r->nombreAbuelito ?>">
          </div>
          <div class="form-group col-6">
            <label for="apellido">Apellido</label>
            <input id="apellido" name="apellido" class="form-control" type="text" value="<?= $r->apellido ?>">
          </div>
          <div class="form-group col-6">
            <label for="fechaNacimiento">Fecha Nacimiento</label>
            <input id="fechaNacimiento" name="fechaNacimiento" class="form-control" type="date" value="<?= $r->fechaNacimiento ?>">
          </div>
          <div class="form-group col-6">
            <label for="necesidades">Necesidad</label>
            <select class="custom-select mr-sm-2 mt-1" name="necesidades" id="necesidades"<?= $r->necesidades ?>>
              <option>Elija...</option>
              <option>Dinero</option>
              <option>Ropa</option>
              <option>Alimentos</option>
              <option>Aseo personal</option>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="examenesMedicos">Examenes medicos</label>
            <select class="custom-select mr-sm-2 mt-1" name="examenesMedicos" id="examenesMedicos" <?= $t->examenesMedicos?>>
              <option>Elija...</option>
              <?php while ($t = $examenes->fetch_object()) : ?>
                <option value="<?= $t->idExamenesMedicos; ?>"><?= $t->nombreExamenesMedico; ?>-<?= $t->fechaExamenesMedicos; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="estadoSalud">Necesidad</label>
            <select class="custom-select mr-sm-2 mt-1" name="estadoSalud" id="estadoSalud"<?= $r->estadoSalud ?>>
              <option>Elija...</option>
              <option>Dinero</option>
              <option>Ropa</option>
              <option>Alimentos</option>
              <option>Aseo personal</option>
            </select>
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
          <th scope="col">Apellido</th>
          <th scope="col">Fecha Nacimiento</th>
          <th scope="col">Examenes Medicos</th>
          <th scope="col">Estado</th>
          <th scope="col">Necesidades</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($a = $abuelito->fetch_object()) : ?>
          <tr class="table-<?= $a->estado == 'Inactivo' ? 'secondary' : ''; ?>">
            <td><?= $a->nombreAbuelito ?></td>
            <td><?= $a->apellido ?></td>
            <td><?= $a->fechaNacimiento ?></td>
            <td><?= $a->nombreExamenesMedico ?></td>
            <td><?= $a->estadoSalud ?></td>
            <td><?= $a->necesidades ?></td>
            <td>
              <a href="<?= baseUrl ?>abuelito/editar&idAbuelito=<?= $a->idAbuelito ?>" class="btn btn-warning btn-sm">editar <i class="fas fa-pencil-alt"></i></a>
              <a href="<?= baseUrl; ?>abuelito/eliminar&idAbuelito=<?= $a->idAbuelito; ?>" class="btn btn-outline-<?= $a->estado == 'Activo' ? 'danger' : ($a->estado == 'Inactivo' ? 'success' : ''); ?> btn-sm">Actualizar <i class="fas fa-exchange-alt"></i></a>
              
              
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