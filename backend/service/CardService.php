<?php

require_once "../modelo/CardModel.php";
require_once "RedSocialService.php";
require_once "PromocionesService.php";
require_once "DetallesService.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE");

try {
    // Crear instancias de servicios y modelos
    $cardModel = new CardModel();
    $redSocialService = new RedSocialService();
    $promocionesService = new PromocionesService();
    $detallesService = new DetallesService();

    // Obtener datos de las tarjetas
    $rpt = $cardModel->Listar();

    $card = [];

    while ($reg = $rpt->fetch_object()) {
        // Construir un array asociativo con los datos de la tarjeta
        $card[] = array(
            "idCard" => $reg->idcard,
            "titulo" => $reg->titulo,
            "descripcionTitulo" => $reg->descripciontitulo,
            "descripcionDetalleTitulo" => $reg->descripciondetalletitulo,
            "megas" => $reg->megas,
            "descripcionMegas" => $reg->descripcionmegas,
            "redesSociales" => $redSocialService->getRedesSociales($reg->idcard),
            "promociones" => $promocionesService->getPromociones($reg->idcard),
            "detalles" => $detallesService->getDetalles($reg->idcard)
        );
    }

    // Devolver el resultado en formato JSON
    $result = $card;
    echo json_encode($result);

} catch (Exception $e) {
    // Manejar cualquier excepción y devolver un mensaje de error
    echo json_encode(array("error" => $e->getMessage()));
}
?>
