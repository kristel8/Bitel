<?php

require "../Config/Conexion.php";

    Class DetallesModel{

        public function __construct(){

        }

        public function listarDetalles ($id){

            $Sql="select titulo, descripcion from detalles where idcard = ".$id.";";
            
            return EjecutarConsulta($Sql);

        }



}

?>