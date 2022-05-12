<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$mensaje = $_POST["mensaje"];

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
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Ecovalor - Tiene un nuevo mensaje desde su Web"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "{$mensajeHtml} <br /><br />Enviado desde su Web Ecovalor.<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurrió un error inesperado.";
}
