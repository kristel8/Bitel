<?php

require "../Config/Conexion.php";

class DetallesModel {
    public function __construct() {
    }

    public function listarDetalles($id) {
        // Validar y filtrar datos de entrada
        $id = limpiarCadena($id);

        // Consulta SQL preparada
        $sql = "SELECT titulo, descripcion FROM detalles WHERE idcard = ?";

        // Preparar y ejecutar la consulta
        $stmt = $GLOBALS['Conexion']->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        // Manejar errores y retornar el resultado
        if (!$result) {
            // Manejar el error, por ejemplo, lanzar una excepción o registrar el error.
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener resultados
        $stmt->bind_result($titulo, $descripcion);
        $detalles = array();

        while ($stmt->fetch()) {
            $detalles[] = array(
                'titulo' => $titulo,
                'descripcion' => $descripcion
            );
        }

        $stmt->close();

        return $detalles;
    }
}

?>
