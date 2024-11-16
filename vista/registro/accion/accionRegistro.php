<?php

include_once("../../../configuracion.php");

$datos = data_submitted();
$datos['usdeshabilitado'] = '0000-00-00 00:00:00';

$objABMUsuario = new ABMUsuario();

$usmail = $datos['usmail'];
$resultado = $objABMUsuario->buscar(['usmail' => $usmail]);

$response = [];
if(!empty($resultado)){
    $response['status'] = 'error';
    $response['message'] = 'El email esta en uso.';
}else{
    if ($objABMUsuario->alta($datos)) {
        $response['status'] = 'Entro';
        $response['message'] = 'Usuario registrado.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No se pudo registrar el usuario.';
    }
}

//error_log(print_r($response, true));

// Esto enviará la respuesta en formato JSON
echo json_encode($response);



?> 

