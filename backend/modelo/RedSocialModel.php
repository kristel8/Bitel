<?php

require "../Config/Conexion.php";

    Class RedSocialModel{

        public function __construct(){

        }

        public function listarCabeceras ($id){

            $Sql="select distinct(rs.titulo) as titulo from cardredessociales crs inner join redessociales rs on rs.idredessociales=crs.idredessociales where crs.idcard = ".$id.";";
            
            return EjecutarConsulta($Sql);

        }

        public function listarImagenes ($id, $titulo){

            $Sql="select rs.imagen from cardredessociales crs inner join redessociales rs on rs.idredessociales=crs.idredessociales where crs.idcard = ".$id.
            " and rs.titulo = '".$titulo."';";
            
            return EjecutarConsulta($Sql);

        }

}

?>