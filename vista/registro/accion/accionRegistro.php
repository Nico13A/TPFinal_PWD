<?php

include_once("../../../configuracion.php");

$datos = data_submitted();
$datos['usdeshabilitado'] = 0;
$objABMUsuario = new ABMUsuario();



$response = [];



if ($objABMUsuario->alta($datos)) {
    $response['status'] = 'Entro';
    $response['message'] = 'Usuario Registrado.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se pudo registrar el usuario.';
}

echo json_encode($response);

?>

