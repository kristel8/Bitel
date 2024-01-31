<?php 

require_once "Global.php"; 

$Conexion = new mysqli(DB_HOST,DB_USERNAME, DB_PASSWORD,DB_NAME);

mysqli_query($Conexion, 'SET NAMES "'.DB_ENCODE.'"');

if(mysqli_connect_errno()){

    printf("Fallo conexion a la base de datos :\n",mysqli_connect_error());
    exit();
} 

if(!function_exists('EjecutarConsulta')){
function EjecutarConsulta($Sql){

    global $Conexion;
    $Query = $Conexion->query($Sql);
    return $Query;
}

function limpiarCadena($Str){

    global $Conexion;
    $Str = rtrim(strtoupper($Str));
    return $Str;
}

}

?>