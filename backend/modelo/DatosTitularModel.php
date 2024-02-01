<?php

require "../Config/Conexion.php";

class DatosTitularModel {
    public function __construct() {
    }

    public function insertDatosTitular($nombres, $apellidos, $tipodocumento, $numerodocumento, $celularcontacto, $numeroparamigrar, $operadorprocedencia, $modalidadactual) {
        // Validar y filtrar datos de entrada
        $nombres = limpiarCadena($nombres);
        $apellidos = limpiarCadena($apellidos);
        $tipodocumento = limpiarCadena($tipodocumento);
        $numerodocumento = limpiarCadena($numerodocumento);
        $celularcontacto = limpiarCadena($celularcontacto);
        $numeroparamigrar = limpiarCadena($numeroparamigrar);
        $operadorprocedencia = limpiarCadena($operadorprocedencia);
        $modalidadactual = limpiarCadena($modalidadactual);

        // Consulta SQL preparada
        $sql = "INSERT INTO datostitular (nombres, apellidos, tipodocumento, numerodocumento, celularcontacto, numeroparamigrar, operadorprocedencia, modalidadactual)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar y ejecutar la consulta
        $stmt = $GLOBALS['Conexion']->prepare($sql);
        $stmt->bind_param("ssssssss", $nombres, $apellidos, $tipodocumento, $numerodocumento, $celularcontacto, $numeroparamigrar, $operadorprocedencia, $modalidadactual);
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
