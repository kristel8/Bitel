<?php

require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';
require '../lib/PHPMailer/src/Exception.php';
require_once "../utils/BodyMessage.php";

header("Access-Control-Allow-Origin: *");

function limpiarCadena($Str) {
    global $Conexion;
    $Str = rtrim(strtoupper($Str));
    return $Str;
}

// Obtener datos del formulario
// ...

$bodyMessage = new BodyMessage();

// Configuración de la cuenta de Gmail
try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    // Resto de la configuración...

    // Configuración del correo
    $mail->setFrom('krivi.no.reply@gmail.com', 'krivi-no-reply');
    $mail->addAddress('redmovilgrupo@gmail.com', 'redmovilgrupo@gmail.com');
    $mail->Subject = 'ALERTA DE NUEVO REGISTRO EN LA WEB';
    $mail->Body = $bodyMessage->getBodyMessage(/*...*/);

    // Intentar enviar el correo
    $mail->send();
    
    // Éxito al enviar el correo
    $results = array(
        "saveInfo" => true,
        "sendEmail" => true
    );
    echo json_encode($results);
} catch (Exception $e) {
    // Manejar errores al enviar el correo
    $results = array(
        "saveInfo" => true,
        "sendEmail" => false,
        "error" => $e->getMessage()
    );
    echo json_encode($results);
}
?>
