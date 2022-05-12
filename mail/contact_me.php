<?php
require("class.phpmailer.php");
require("class.smtp.php");

// // Valores enviados desde el formulario // Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "Argumento no proveido!";
   return false;
   }
 
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "wi382045.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "cam@ecovalor.com.ar";  // Mi cuenta de correo
$smtpClave = "Chalo863";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "cam@ecovalor.com.ar";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $name;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Ecovalor - Tienes un nuevo mensaje desde tu Web ECOVALOR"; // Este es el titulo del email.
$mensajeHtml = nl2br($message);
$mail->Body = "{$mensajeHtml} <br /><br />"."Aquí los detalles:\n\nNombre: $name <br /> Email: $email_address <br /> Teléfono: $phone.<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$message} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    return true; 
} else {
    echo "Ocurrió un error inesperado.";
}

      
?>