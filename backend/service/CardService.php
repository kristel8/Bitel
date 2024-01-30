<?php

require_once "../modelo/CardModel.php";
require_once "RedSocialService.php";
require_once "PromocionesService.php";
require_once "DetallesService.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE");

$cardModel = new CardModel();
$redSocialService = new RedSocialService();
$promocionesService = new PromocionesService();
$detallesService = new DetallesService();

    $rpt=$cardModel->Listar();

    $card = Array();

    while($reg=$rpt->fetch_object()){

        $card[]=array(

            "idCard"=>$reg->idcard,
            "titulo"=>$reg->titulo,
            "descripcionTitulo"=>$reg->descripciontitulo,
            "descripcionDetalleTitulo"=>$reg->descripciondetalletitulo,
            "megas"=>$reg->megas,
            "descripcionMegas"=>$reg->descripcionmegas,
            "redesSociales"=>$redSocialService->getRedesSociales($reg->idcard),
            "promociones"=>$promocionesService->getPromociones($reg->idcard),
            "detalles"=> $detallesService->getDetalles($reg->idcard)
            
        );
    }

    $Result = $card;

        echo json_encode($Result);

?>