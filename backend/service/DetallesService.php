<?php

require_once "../modelo/DetallesModel.php";

class DetallesService {

    public function __construct() {
    }

    public function getDetalles($idCard) {
        try {
            $detallesModel = new DetallesModel();
            $rpt = $detallesModel->listarDetalles($idCard);

            $detalles = [];

            while ($reg = $rpt->fetch_object()) {
                $detalles[] = [
                    "titulo" => $reg->titulo,
                    "descripcion" => $reg->descripcion
                ];
            }

            // Cerrar el recurso (en este caso, el resultado de la consulta)
            $rpt->close();

            return $detalles;
        } catch (Exception $e) {
            // Manejar cualquier excepción y devolver un mensaje de error
            return ["error" => $e->getMessage()];
        }
    }
}

?>
