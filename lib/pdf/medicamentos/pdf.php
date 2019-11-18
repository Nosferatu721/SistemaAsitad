<?php
require 'lib/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();

ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF</title>
  <style>
    * {
      padding: 0px;
      margin: 0px;
      box-sizing: border-box
    }

    h1 {
      text-align: center;
    }

    .Head {
      padding: 15px;
      background: #ffffff
    }

    hr {
      border: 0.3px;
      color: blue
    }

    th{
      width: 120px
    }
    .Head p {
      margin: 2px
    }

    .Body h4 {
      margin: 2px;
      text-align: center
    }

    .email {
      width: 200px
    }

    .Footer {
      padding: 15px;
      background: #ffffff
    }

    h5 {
      text-align: center
    }

    /* Grafico */

    .grafico {
      margin: 10px 0px;
      border-left: 1px solid gray;
      border-bottom: 1px solid gray;
      width: 600px;
      height: 200px;
    }

    .barra {
      height: 50px;
      border: 1px solid gray;
      background: orangered;
      text-align: center;
      margin-top: 10px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="Box">
    <h1>Reporte</h1>
    <hr>
    <div class="Head">
      <h3>Por:</h3>
      <p>Nombre: <?= $_SESSION['userLog']->nombre ?> <?= $_SESSION['userLog']->apellido ?></p>
      <p>Email: <?= $_SESSION['userLog']->email ?></p>
    </div>
    <div class="Body">
      <hr>
      <h4>Medicamentos</h4>
      <hr>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Laboratorio</th>
            <th>Tipo</th>
            <th>Unidades</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($m = $dataM->fetch_object()) : ?>
            <tr>
              <td><?= $m->nombreMedicamento ?></td>
              <td><?= $m->laboratorio ?></td>
              <td><?= $m->tipoMedicamento ?></td>
              <td><?= $m->unidades ?></td>
              <td><?= $m->estado ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <hr>
    </div>
    <div class="Footer">
      <h5>Fecha: <?= date('d-m-Y'); ?></h5>
    </div>
  </div>
</body>

</html>

<?php
$content = ob_get_clean();

$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content);
$html2pdf->output("PDF.pdf");
