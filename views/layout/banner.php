<h2><?= $_SESSION['userLog']->nombre ?> <?= $_SESSION['userLog']->apellido ?> <?= $_SESSION['userLog']->tipoRol ?></h2>
<hr>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Asitad</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav mr-auto">


      <?php if ($_SESSION['userLog']->rol == '1') : ?>

        <a class="nav-item nav-link active" href="<?= baseUrl ?>user/index">Inicio</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>medicamento/gestion">Registrar Medicamento</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>actividad/gestion">Registrar Actividad</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>abuelito/gestion">Abuelito</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>evento/correos">eventos</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>examenes/gestion">examenes</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>donacion/gestion">donacion</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>correos/ingresar">correos</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>apadrinamiento/gestion">apadrinamiento</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>user/gestion">usuario</a>
        <a class="nav-item nav-link text-danger" href="<?= baseUrl ?>user/logout">Salir</a>
        <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>

      <?php elseif ($_SESSION['userLog']->rol = '2') : ?>

        <a class="nav-item nav-link active" href="<?= baseUrl ?>user/index">Inicio</a>
        <a class="nav-item nav-link" href="<?= baseUrl ?>medicamento/gestion">Registrar Medicamento</a>
        <a class="nav-item nav-link text-danger" href="<?= baseUrl ?>user/logout">Salir</a>

      <?php elseif ($_SESSION['identity']->rol = '3') : ?>
        <li class="nav-item dropdown">
          <a class="nav-item nav-link active" href="<?= baseUrl ?>user/index">Inicio</a>
          <a class="nav-item nav-link" href="<?= baseUrl ?>abuelito/gestion">Abuelito</a>
          <a class="nav-item nav-link" href="<?= baseUrl ?>evento/gestion">eventos</a>
          <a class="nav-item nav-link" href="<?= baseUrl ?>examenes/gestion">examenes</a>
          <a class="nav-item nav-link" href="<?= baseUrl ?>donacion/gestion">donacion</a>
          <a class="nav-item nav-link" href="<?= baseUrl ?>user/registrar">usuario</a>
          <a class="nav-item nav-link text-danger" href="<?= baseUrl ?>user/logout">Salir</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>