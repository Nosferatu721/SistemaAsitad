<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Correos</title>
    </head>
    <body>
        <?php
            // Libreria PHPMailer
            require './Resources/PHPMailer/PHPMailerAutoload.php';
            
            // Creamos una nueva instancia
            $mail = new PHPMailer();
 
            // Activamos el servicio SMTP
            try {
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );                
            
            $mail->isSMTP();
            // Activamos / Desactivamos el "debug" de SMTP (Lo activo para ver en el HTML el resultado)
            // 0 = Apagado 
            // 1 = Mensaje de Cliente 
            // 2 = Mensaje de Cliente y Servidor 
            $mail->smtpDebug = 2; 

            // Log del debug SMTP en formato HTML 
            $mail->Debugoutput = 'html'; 

            // Servidor SMTP (para este ejemplo utilizamos gmail) 
            $mail->Host = 'smtp.gmail.com'; 

            // Puerto SMTP 
            $mail->Port = 587;
 
            // Tipo de encriptacion SSL ya no se utiliza se recomienda TSL 
            $mail->SMTPSecure = 'tls'; 

            // Si necesitamos autentificarnos 
            $mail->SMTPAuth = true; 

            // Usuario del correo desde el cual queremos enviar, para Gmail recordar usar el usuario completo (usuario@gmail.com) 
            $mail->Username = "sistemasitad@gmail.com"; 

            // Contraseña 
            $mail->Password = "1694163B"; 
 
            // Conectamos a la base de datos 
            //El orden es: dirección del host, usuario, contraseña, nombre de la base de datos.
            $db = new mysqli('localhost', 'root', '', 'betanueva'); 

            if ($db->connect_errno > 0) 
            {
                die('Error connect: [' . $db->connect_error . ']'); 
            } 

            // Creamos la sentencias SQL 
            $result = $db->query("SELECT email, nombre, apellido FROM usuarios;");

            // Iniciamos el "bucle" para enviar multiples correos. 
            while($row = $result->fetch_assoc())
            { 
                //Añadimos la direccion de quien envia el corre, en este caso 
                //YARR Blog, primero el correo, luego el nombre de quien lo envia. 
                $mail->setFrom('sistemasitad@gmail.com', 'FUNDACION ASITAD'); 
                $mail->addAddress($row['email'], $row['nombre'],$row['apellido']); 

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
                $mail->addAttachment($_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']);
                                    //La linea de asunto 
                $asuntob = $_POST['asunto'];
                $mail->Subject = $asuntob;

                $mail->Body ='<b>hola como estas </b><br>Bienvenido';
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
                $message = "Hello ".$row['nombre']." ".$row['apellido'].", this is a email message from asitad.";
                
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