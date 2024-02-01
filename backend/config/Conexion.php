<?php

require_once "Global.php";

class Conexion {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        mysqli_query($this->conexion, 'SET NAMES "'.DB_ENCODE.'"');

        if ($this->conexion->connect_errno) {
            throw new Exception("Fallo conexión a la base de datos: " . $this->conexion->connect_error);
        }
    }

    public function ejecutarConsulta($sql) {
        $query = $this->conexion->query($sql);

        if (!$query) {
            throw new Exception("Error en la consulta: " . $this->conexion->error);
        }

        return $query;
    }

    public function limpiarCadena($str) {
        // Ejemplo básico para eliminar espacios en blanco al inicio y al final
        $str = trim($str);
        return $str;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}

// Uso de la clase
$miConexion = new Conexion();
// Ejemplo de consulta
$resultado = $miConexion->ejecutarConsulta("SELECT * FROM miTabla");
$miConexion->cerrarConexion();

?>
