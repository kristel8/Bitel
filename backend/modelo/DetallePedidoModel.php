<?php

require "../Config/Conexion.php";

    Class DetallePedidoModel{

        public function __construct(){

        }

        public function insertDetallePedido($producto, $modalidad, $cantidad, $total){

            $Sql="insert into detallepedido(producto, modalidad, cantidad, total, iddatosentrega, iddatostitular) values (
                '".$producto."',
                '".$modalidad."',
                '".$cantidad."',
                '".$total."',
                (select iddatosentrega from datosentrega order by iddatosentrega desc limit 1),
                (select iddatostitular from datostitular order by iddatostitular desc limit 1)
            );";
            
            return EjecutarConsulta($Sql);

        }



}

?>