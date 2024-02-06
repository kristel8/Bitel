<?php

require "../Config/Conexion.php";

class DetallePedidoModel {
    public function __construct() {
    }

    public function insertDetallePedido($producto, $modalidad, $cantidad, $total) {
        // Validar y filtrar datos de entrada
        $producto = limpiarCadena($producto);
        $modalidad = limpiarCadena($modalidad);
        $cantidad = limpiarCadena($cantidad);
        $total = limpiarCadena($total);

        // Consulta SQL preparada
        $sql = "INSERT INTO detallepedido (producto, modalidad, cantidad, total, iddatosentrega, iddatostitular)
                VALUES (?, ?, ?, ?, (SELECT iddatosentrega FROM datosentrega ORDER BY iddatosentrega DESC LIMIT 1),
                (SELECT iddatostitular FROM datostitular ORDER BY iddatostitular DESC LIMIT 1))";

        // Preparar y ejecutar la consulta
        $stmt = $GLOBALS['Conexion']->prepare($sql);
        $stmt->bind_param("ssss", $producto, $modalidad, $cantidad, $total);
        $result = $stmt->execute();

        // Manejar errores y retornar el resultado
        if (!$result) {
            // Manejar el error, por ejemplo, lanzar una excepción o registrar el error.
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        return $result;
    }
}

?>
