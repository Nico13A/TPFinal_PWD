<?php

include_once("../../../configuracion.php");

$datos = data_submitted();
$datos['usdeshabilitado'] = null;
$objABMUsuario = new ABMUsuario();



$response = [];
if ($objABMUsuario->alta($datos)) {
    $response['status'] = 'Entro';
    $response['message'] = 'Usuario registrado.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se pudo registrar el usuario.';
}


//error_log(print_r($response, true));

// Esto enviará la respuesta en formato JSON
echo json_encode($response);



?> 

