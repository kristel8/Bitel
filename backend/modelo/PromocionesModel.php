<?php

require "../Config/Conexion.php";

    Class PromocionesModel{

        public function __construct(){

        }

        public function listarPromociones($id){

            $Sql="select p.nombrepromo, p.cantidadmegas, p.imagenpromo, p.duracion from cardpromociones cp 
            inner join promociones p on p.idpromociones= cp.idpromociones where cp.idcard = ".$id.";";
            
            return EjecutarConsulta($Sql);

        }


}

?>