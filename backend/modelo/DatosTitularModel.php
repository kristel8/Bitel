<?php

require "../Config/Conexion.php";

    Class DatosTitularModel{

        public function __construct(){

        }

        public function insertDatostitular ($nombres, $apellidos, $tipodocumento, $numerodocumento, $celularcontacto, $numeroparamigrar, $operadorprocedencia, $modalidadactual){

            $Sql="insert into datostitular(nombres,apellidos, tipodocumento,numerodocumento, celularcontacto,numeroparamigrar,operadorprocedencia, modalidadactual) values (
                '".$nombres."',
                '".$apellidos."',
                '".$tipodocumento."',
                '".$numerodocumento."',
                '".$celularcontacto."',
                '".$numeroparamigrar."',
                '".$operadorprocedencia."',
                '".$modalidadactual."'
            );";
            
            return EjecutarConsulta($Sql);

        }



}

?>