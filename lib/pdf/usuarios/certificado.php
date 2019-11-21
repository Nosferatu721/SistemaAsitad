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
    h1,
    h2 {
      text-align: center;
      padding: 40px 0;
    }

    p {
      margin: 10px 60px;
      padding: 80px 0;
    }
    img{
      width: 150px;
      margin-left: 40%;
      padding: 20px 0;
    }
  </style>
</head>

<body>
  <div class="Box">
    <img src="assets/modules/img/logo.png">
    <h1>Asitad</h1>
    <div class="Body">
      <h2>Certifica:</h2>
      <p>Que <?= $dataUser->nombre ?> <?= $dataUser->apellido ?> bla bla bla
        <h5>Fecha: <?= date('d-m-Y'); ?></h5>
      </p>
    </div>
  </div>
</body>

</html>

<?php
$content = ob_get_clean();

$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content);
$html2pdf->output("PDF.pdf");
