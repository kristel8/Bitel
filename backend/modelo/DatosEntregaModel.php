<?php

require "../Config/Conexion.php";

class DatosEntregaModel {
    public function __construct() {
    }

    public function saveDatosEntrega($departamento, $provincia, $distrito, $direccion, $numero, $referencia, $horarioentrega, $metodopago) {
        // Validar y filtrar datos de entrada
        $departamento = limpiarCadena($departamento);
        $provincia = limpiarCadena($provincia);
        $distrito = limpiarCadena($distrito);
        $direccion = limpiarCadena($direccion);
        $numero = limpiarCadena($numero);
        $referencia = limpiarCadena($referencia);
        $horarioentrega = limpiarCadena($horarioentrega);
        $metodopago = limpiarCadena($metodopago);

        // Consulta SQL preparada
        $sql = "INSERT INTO datosentrega (departamento, provincia, distrito, direccion, numero, referencia, horarioentrega, metodopago)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar y ejecutar la consulta
        $stmt = $GLOBALS['Conexion']->prepare($sql);
        $stmt->bind_param("ssssssss", $departamento, $provincia, $distrito, $direccion, $numero, $referencia, $horarioentrega, $metodopago);
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
