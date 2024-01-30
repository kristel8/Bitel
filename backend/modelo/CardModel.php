<?php

require "../Config/Conexion.php";

    Class CardModel{

        public function __construct(){

        }

        public function Listar (){

            $Sql="select c.idcard, c.titulo, c.descripciontitulo, c.descripciondetalletitulo, c.megas, c.descripcionmegas from card c;";
            
            return EjecutarConsulta($Sql);

        }



}

?>