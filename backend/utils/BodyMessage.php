<?php

class BodyMessage
{
    public function __construct()
    {
    }

    public function getPedidoBodyMessage(
        $producto,
        $modalidad,
        $cantidad,
        $departamento,
        $provincia,
        $distrito,
        $direccion,
        $numero,
        $referencia,
        $horarioentrega,
        $metodopago,
        $nombres,
        $apellidos,
        $tipodocumento,
        $numerodocumento,
        $celularcontacto,
        $numeroparamigrar,
        $operadorprocedencia,
        $modalidadactual
    ) {
        $bodyMessage = "NUEVO REGISTRO EN LA WEB:\n\n" .
            "DETALLE DE PEDIDO: \n" .
            "Producto: " . $producto . "\n" .
            "Modalidad: " . $modalidad . "\n" .
            "Cantidad: " . $cantidad . "\n\n" .
            "DATOS PARA LA ENTREGA: \n" .
            "Departamento: " . $departamento . "\n" .
            "Provincia: " . $provincia . "\n" .
            "Distrito: " . $distrito . "\n" .
            "Direccion: " . $direccion . "\n" .
            "Numero: " . $numero . "\n" .
            "Referencia: " . $referencia . "\n" .
            "Horario de Entrega: " . $horarioentrega . "\n" .
            "Método de pago: " . $metodopago . "\n\n" .
            "DATOS DEL TITULAR: \n" .
            "Nombres: " . $nombres . "\n" .
            "Apellidos: " . $apellidos . "\n" .
            "Tipo de documento: " . $tipodocumento . "\n" .
            "Numero de documento: " . $numerodocumento . "\n" .
            "Celular de Contacto: " . $celularcontacto . "\n" .
            "Numero para migrar: " . $numeroparamigrar . "\n" .
            "Operador de procedencia: " . $operadorprocedencia . "\n" .
            "Modalidad Actual: " . $modalidadactual . "\n";

        return $bodyMessage;
    }

    public function getInformacionPlanesBodyMessage(
        $celularcontacto
    ) {
        $bodyMessage = "El siguiente número desea información sobre los planes: " . $celularcontacto;

        return $bodyMessage;
    }
}

?>
