<?php

require_once "../Config/Conexion.php";

class RedSocialModel {

    public function __construct() {
    }

    public function listarCabeceras($id) {
        // Validar y filtrar datos de entrada
        $id = limpiarCadena($id);

        // Consulta SQL preparada
        $sql = "SELECT DISTINCT(rs.titulo) as titulo FROM cardredessociales crs 
                INNER JOIN redessociales rs ON rs.idredessociales = crs.idredessociales 
                WHERE crs.idcard = ?";

        // Preparar y ejecutar la consulta
        $stmt = $GLOBALS['Conexion']->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        // Manejar errores y retornar el resultado
        if (!$result) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener resultados
        $stmt->bind_result($titulo);
        $cabeceras = array();

        while ($stmt->fetch()) {
            $cabeceras[] = array(
                'titulo' => $titulo
            );
        }

        $stmt->close();

        return $cabeceras;
    }

    public function listarImagenes($id, $titulo) {
        // Validar y filtrar datos de entrada
        $id = limpiarCadena($id);
        $titulo = limpiarCadena($titulo);

        // Consulta SQL preparada
        $sql = "SELECT rs.imagen FROM cardredessociales crs 
                INNER JOIN redessociales rs ON rs.idredessociales = crs.idredessociales 
                WHERE crs.idcard = ? AND rs.titulo = ?";

        // Preparar y ejecutar la consulta
        $stmt = $GLOBALS['Conexion']->prepare($sql);
        $stmt->bind_param("is", $id, $titulo);
        $result = $stmt->execute();

        // Manejar errores y retornar el resultado
        if (!$result) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener resultados
        $stmt->bind_result($imagen);
        $imagenes = array();

        while ($stmt->fetch()) {
            $imagenes[] = array(
                'imagen' => $imagen
            );
        }

        $stmt->close();

        return $imagenes;
    }
}

?>
