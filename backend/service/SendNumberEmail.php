<?php

require_once "../utils/BodyMessage.php";
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';
require '../lib/PHPMailer/src/Exception.php';
header("Access-Control-Allow-Origin: *");

function limpiarCadena($Str) {
    global $Conexion;
    $Str = rtrim(strtoupper($Str));
    return $Str;
}

$celularcontacto = isset($_REQUEST["celularcontacto"]) ? limpiarCadena($_REQUEST["celularcontacto"]) : "";

$bodyMessage = new BodyMessage();

// Crea una instancia de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER; // Activa el modo debug para obtener más información (opcional)
$mail->Host = 'smtp.gmail.com'; // Servidor SMTP (Ejemplo: smtp.gmail.com)
$mail->Port = 587; // Puerto SMTP (Ejemplo: 587 para TLS o 465 para SSL)
$mail->SMTPSecure = 'tls'; // Opciones: 'tls' o 'ssl'
$mail->SMTPAuth = true; // Habilita la autenticación SMTP
$mail->Username = 'krivi.no.reply@gmail.com'; // Correo electrónico del remitente
$mail->Password = 'ltncicwdroddhnst'; // Contraseña del remitente

$mail->setFrom('krivi.no.reply@gmail.com', 'krivi-no-reply'); // Dirección y nombre del remitente
$mail->addAddress('redmovilgrupo@gmail.com', 'redmovilgrupo@gmail.com'); // Dirección y nombre del destinatario
$mail->Subject = 'SOLICITUD DE INFORMACION SOBRE PLANES'; // Asunto del correo
$mail->Body = $bodyMessage->getBodyMessageNumber($celularcontacto);

try {
    $mail->send();
    $results = array("sendEmail" => true);
    echo json_encode($results);
} catch (Exception $e) {
    $results = array("sendEmail" => false, "error" => $e->getMessage());
    echo json_encode($results);
}

?>
