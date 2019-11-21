<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$nombre = $dataUser->nombre;
$apellido = $dataUser->apellido;
$email = $dataUser->email;
$pass = $dataUser->contrasena;

require 'lib/vendor/autoload.php';
require 'lib/emails/constante.php';

$mail = new PHPMailer(true);

try {
  $mail->SMTPDebug = 2;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;

  $mail->Username = 'sistemasitad@gmail.com';
  $mail->Password = '1694163B';

  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $db = new mysqli('localhost', 'root', '', 'betanueva');
  if ($db->connect_errno > 0) {
    die('Error connect: [' . $db->connect_error . ']');
  }
  while ($row = $result->fetch_assoc()) {
    //Añadimos la direccion de quien envia el corre, en este caso 
    //YARR Blog, primero el correo, luego el nombre de quien lo envia. 
    $mail->setFrom('sistemasitad@gmail.com', 'Asitad');
    $mail->addAddress($row['email'], $row['nombre'], $row['apellido']);

    /*if (isset($_FILES) && (bool) $_FILES) {
                    $extencion=array("pdf","doc","docx","gif","jpeg","jpg","png","txt","exe");

                    $files=array();

                    foreach ($_FILES as $name => $file) {
                        $file_name= $file['name'];
                        $file_type= $file['type'];
                        $patch_parts=pathinfo($file_name);
                        $ext=$patch_parts['extension'];
                        if (!in_array($ext, $extencion)) {
                            die("File $file_name has the row $ext is not");
                        }
                        array_push($files, $file);
                    }
                }*/

    //$name_file=$_FILES['archivo']['name'];
    //$ubica_file=$_FILES['archivo']['tmp_name'];
    $mail->addAttachment($_FILES['archivo']['tmp_name'], $_FILES['archivo']['name']);
    //La linea de asunto 
    $asuntob = $_POST['asunto'];
    $mail->Subject = $asuntob;

    $mail->Body = '<b>hola como estas </b><br>Bienvenido';
    $mail->IsHTML(true);

    /*
                 * Existen dos formas de mandar un correo:
                 * - Escribiendo el mensaje en un String y mandarlo. (Así se va hacer en el ejemplo).
                 * - Crear un HTML e ingresarlo Se haría así:
                 * $mail->msgHTML(file_get_contents('contenido.html'), dirname(__FILE__)); 
                 * PHPMailer permite insertar imágenes, css, etc.
                 * NOTA: No se recomienda el uso de JavaScript.
                 * 
                 * Mediante un String se haría así:
                 */
    //Creamos el mensaje
    $mensajeb = $_POST['mensaje'];
    $message = "Hello " . $row['nombre'] . " " . $row['apellido'] . ", this is a email message from julian.";

    //Agregamos el mensaje al correo
    //$mail->msgHTML(file_get_contents('vista.php'), dirname(__FILE__));

    $mail->msgHTML($mensajeb);

    // Enviamos el Mensaje 
    $mail->send();

    // Borramos el destinatario, de esta forma nuestros clientes no ven los correos de las otras personas y parece que fuera un único correo para ellos. 
    $mail->ClearAddresses();
  }
  echo "Se envio correctamente";
} catch (Exception $e) {
  echo "Hubo un error no se pudo enviar el mensaje: ", $email->ErrorInfo;
}
?>
</body>

</html>