<?php

require_once "../modelo/RedSocialModel.php";

class RedSocialService {

    public function __construct() {
    }

    public function getRedesSociales($idCard) {
        try {
            $redSocialModel = new RedSocialModel();
            $rpt = $redSocialModel->listarCabeceras($idCard);

            $redSocial = [];

            while ($reg = $rpt->fetch_object()) {
                $redSocial[] = [
                    "titulo" => $reg->titulo,
                    "redes" => $this->getImagenesRedes($idCard, $reg->titulo)
                ];
            }

            // Cerrar el recurso (en este caso, el resultado de la consulta)
            $rpt->close();

            return $redSocial;
        } catch (Exception $e) {
            // Manejar cualquier excepción y devolver un mensaje de error
            return ["error" => $e->getMessage()];
        }
    }

    public function getImagenesRedes($idCard, $titulo) {
        try {
            $redSocialModel = new RedSocialModel();
            $rpt = $redSocialModel->listarImagenes($idCard, $titulo);

            $imagen = [];

            while ($reg = $rpt->fetch_object()) {
                $imagen[] = [
                    "imagen" => $reg->imagen
                ];
            }

            // Cerrar el recurso (en este caso, el resultado de la consulta)
            $rpt->close();

            return $imagen;
        } catch (Exception $e) {
            // Manejar cualquier excepción y devolver un mensaje de error
            return ["error" => $e->getMessage()];
        }
    }
}

?>
