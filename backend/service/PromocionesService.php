<?php

require_once "../modelo/PromocionesModel.php";

class PromocionesService {

    public function __construct() {
    }

    public function getPromociones($idCard) {
        try {
            $promocionesModel = new PromocionesModel();
            $rpt = $promocionesModel->listarPromociones($idCard);

            $promociones = [];

            while ($reg = $rpt->fetch_object()) {
                $promociones[] = [
                    "nombrePromo" => $reg->nombrepromo,
                    "cantidadMegas" => $reg->cantidadmegas,
                    "imagenPromo" => $reg->imagenpromo,
                    "duracion" => $reg->duracion
                ];
            }

            // Cerrar el recurso (en este caso, el resultado de la consulta)
            $rpt->close();

            return $promociones;
        } catch (Exception $e) {
            // Manejar cualquier excepción y devolver un mensaje de error
            return ["error" => $e->getMessage()];
        }
    }
}

?>
