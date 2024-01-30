<?php

require_once "../modelo/PromocionesModel.php";

Class PromocionesService{

    public function __construct(){

    }

    public function getPromociones ($idCard){

        $promocionesModel = new PromocionesModel();
        
        $rpt=$promocionesModel->listarPromociones($idCard);
        
        $promociones = Array();

        while($reg=$rpt->fetch_object()){

          
            $promociones[]=array(
    
                "nombrePromo"=>$reg->nombrepromo,
                "cantidadMegas"=>$reg->cantidadmegas,
                "imagenPromo"=>$reg->imagenpromo,
                "duracion"=>$reg->duracion
                
            );
        }

        return $promociones;

    }

}



?>