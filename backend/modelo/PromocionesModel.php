<?php

require_once "../Config/Conexion.php";

class PromocionesModel {

    public function __construct() {
    }

    public function listarPromociones($id) {
        // Validar y filtrar datos de entrada
        $id = limpiarCadena($id);

        // Consulta SQL preparada
        $sql = "SELECT p.nombrepromo, p.cantidadmegas, p.imagenpromo, p.duracion FROM cardpromociones cp
                INNER JOIN promociones p ON p.idpromociones = cp.idpromociones
                WHERE cp.idcard = ?";

        // Preparar y ejecutar la consulta
        $stmt = $GLOBALS['Conexion']->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        // Manejar errores y retornar el resultado
        if (!$result) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener resultados
        $stmt->bind_result($nombrepromo, $cantidadmegas, $imagenpromo, $duracion);
        $promociones = array();

        while ($stmt->fetch()) {
            $promociones[] = array(
                'nombrepromo' => $nombrepromo,
                'cantidadmegas' => $cantidadmegas,
                'imagenpromo' => $imagenpromo,
                'duracion' => $duracion
            );
        }

        $stmt->close();

        return $promociones;
    }
}

?>
