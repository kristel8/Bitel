<?php

require "../Config/Conexion.php";

    Class DatosEntregaModel{

        public function __construct(){

        }

        public function saveDatosEntrega ($departamento, $provincia, $distrito, $direccion, $numero, $referencia, $horarioentrega, $metodopago){

            $Sql="insert into datosentrega(departamento, provincia, distrito, direccion, numero, referencia, horarioentrega, metodopago) values (
                '".$departamento."',
                '".$provincia."',
                '".$distrito."',
                '".$direccion."',
                '".$numero."',
                '".$referencia."',
                '".$horarioentrega."',
                '".$metodopago."'
            );";
            
            return EjecutarConsulta($Sql);

        }



}

?>