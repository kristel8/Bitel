<?php
/*
require_once "../modelo/DatosEntregaModel.php";
require_once "../modelo/DatosTitularModel.php";
require_once "../modelo/DetallePedidoModel.php";*/
require_once "../utils/BodyMessage.php";

header("Access-Control-Allow-Origin: *");

/*
$datosEntregaModel = new DatosEntregaModel();
$datosTitularModel = new DatosTitularModel();
$detallePedidoModel = new DetallePedidoModel();*/

function limpiarCadena($Str){

    global $Conexion;
    $Str = rtrim(strtoupper($Str));
    return $Str;
}

$bodyMessage = new BodyMessage();

$producto=isset($_REQUEST["producto"])? limpiarCadena($_REQUEST["producto"]):"";
$modalidad=isset($_REQUEST["modalidad"])? limpiarCadena($_REQUEST["modalidad"]):""; 
$cantidad=isset($_REQUEST["cantidad"])? limpiarCadena($_REQUEST["cantidad"]):"";
$total=isset($_REQUEST["total"])? limpiarCadena($_REQUEST["total"]):"";

$departamento=isset($_REQUEST["departamento"])? limpiarCadena($_REQUEST["departamento"]):"";
$provincia=isset($_REQUEST["provincia"])? limpiarCadena($_REQUEST["provincia"]):"";
$distrito=isset($_REQUEST["distrito"])? limpiarCadena($_REQUEST["distrito"]):""; 
$direccion=isset($_REQUEST["direccion"])? limpiarCadena($_REQUEST["direccion"]):"";
$numero=isset($_REQUEST["numero"])? limpiarCadena($_REQUEST["numero"]):"";
$referencia=isset($_REQUEST["referencia"])? limpiarCadena($_REQUEST["referencia"]):"";
$horarioentrega=isset($_REQUEST["horarioentrega"])? limpiarCadena($_REQUEST["horarioentrega"]):"";
$metodopago=isset($_REQUEST["metodopago"])? limpiarCadena($_REQUEST["metodopago"]):"";


$nombres=isset($_REQUEST["nombres"])? limpiarCadena($_REQUEST["nombres"]):"";
$apellidos=isset($_REQUEST["apellidos"])? limpiarCadena($_REQUEST["apellidos"]):"";
$tipodocumento=isset($_REQUEST["tipodocumento"])? limpiarCadena($_REQUEST["tipodocumento"]):"";
$numerodocumento=isset($_REQUEST["numerodocumento"])? limpiarCadena($_REQUEST["numerodocumento"]):"";
$celularcontacto=isset($_REQUEST["celularcontacto"])? limpiarCadena($_REQUEST["celularcontacto"]):"";
$numeroparamigrar=isset($_REQUEST["numeroparamigrar"])? limpiarCadena($_REQUEST["numeroparamigrar"]):"";
$operadorprocedencia=isset($_REQUEST["operadorprocedencia"])? limpiarCadena($_REQUEST["operadorprocedencia"]):"";
$modalidadactual=isset($_REQUEST["modalidadactual"])? limpiarCadena($_REQUEST["modalidadactual"]):"";


/*
$datosEntregaModel->saveDatosEntrega($departamento, $provincia, $distrito, $direccion, $numero, $referencia, $horarioentrega, $metodopago);
$datosTitularModel->insertDatostitular($nombres, $apellidos, $tipodocumento, $numerodocumento, $celularcontacto, $numeroparamigrar, $operadorprocedencia, $modalidadactual);
$detallePedidoModel->insertDetallePedido($producto, $modalidad, $cantidad, $total);
*/

// Configuración de la cuenta de Gmail

require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';
require '../lib/PHPMailer/src/Exception.php';

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
$mail->Subject = 'ALERTA DE NUEVO REGISTRO EN LA WEB'; // Asunto del correo
$mail->Body = $bodyMessage->getBodyMessage($producto,
$modalidad,
$cantidad,
$departamento,
$provincia,
$distrito,
$direccion,
$numero,
$referencia,
$horarioentrega,
$metodopago,
$nombres,
$apellidos,
$tipodocumento,
$numerodocumento,
$celularcontacto,
$numeroparamigrar,
$operadorprocedencia,
$modalidadactual); // Contenido del correo

try {
    $mail->send();
    //echo "Correo enviado exitosamente!";
    $results = array(
        "saveInfo"=>true, //Información para el datatables
        "sendEmail"=>true);
    echo json_encode($results);
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}



?>