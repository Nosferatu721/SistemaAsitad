<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'lib/vendor/autoload.php';
require 'lib/email/constante.php';

// IMPORTANTE
// Correo y Contraseña de la Cuenta
$email = 'kjajskdjkajsd@gmail.com';
$passEmail = 'okghokgotllg';


$mail = new PHPMailer(true);
try {
  $mail->SMTPDebug = 2;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;

  $mail->Username = $email;
  $mail->Password = $passEmail;

  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  // Mensaje pa enviar
  $mail->setFrom($email, 'Asitad');
  $mail->addAddress($email);
  
  $mail->isHTML(true);
  $mail->CharSet = 'UTF-8';
  $mail->Subject = 'Contraseña';
  $mail->Body = $data->nombre . ' ' . $data->apellido . '<br>'
    . 'Contraseña: ' . $data->PASSWORD;
  if ($mail->send()) {
    header('Location: ' . baseUrl);
  } else {
    echo 'Yuca';
  }
} catch (Exception $e) {
  echo 'Algo salio mal' . $e->getMessage();
}
