<?php

require_once "../modelo/DetallesModel.php";

Class DetallesService{

    public function __construct(){

    }

    public function getDetalles ($idCard){

        $detallesModel = new DetallesModel();
        
        $rpt=$detallesModel->listarDetalles($idCard);
        
        $detalles = Array();

        while($reg=$rpt->fetch_object()){

          
            $detalles[]=array(
    
                "titulo"=>$reg->titulo,
                "descripcion"=>$reg->descripcion
            );
        }

        return $detalles;

    }

}



?>