<?php

require "../Config/Conexion.php";

class CardModel {
    public function __construct() {
    }

    public function listar() {
        $sql = "SELECT idcard, titulo, descripciontitulo, descripciondetalletitulo, megas, descripcionmegas FROM card;";
        $result = EjecutarConsulta($sql);

        if (!$result) {
            // Manejar el error, por ejemplo, lanzar una excepción o registrar el error.
            throw new Exception("Error al ejecutar la consulta: " . $sql);
        }

        return $result;
    }
}

?>

