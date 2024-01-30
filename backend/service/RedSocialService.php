<?php


require_once "../modelo/RedSocialModel.php";


Class RedSocialService{

    public function __construct(){

    }

    public function getRedesSociales ($idCard){

        $redSocialModel = new RedSocialModel();
        
        $rpt=$redSocialModel->listarCabeceras($idCard);
        
        $redSocial = Array();

        while($reg=$rpt->fetch_object()){

          
            $redSocial[]=array(
    
                "titulo"=>$reg->titulo,
                "redes"=> $this->getImagenesRedes($idCard, $reg->titulo)
                
                
            
            );
        }

        return $redSocial;

    }



    public function getImagenesRedes ($idCard, $titulo){

        $redSocialModel = new RedSocialModel();
        
        $rpt=$redSocialModel->listarImagenes($idCard, $titulo);
        
        $imagen = Array();

        while($reg=$rpt->fetch_object()){

            $imagen[]=array(
    
                "imagen"=>$reg->imagen
                
            
            );
        }

        return $imagen;

    }



}



?>