<?php

include_once('../../configuracion.php');

$objSesion = new Session();
$cierreSesion = $objSesion->cerrar();
if ($cierreSesion) {
    echo json_encode(['success' => true, 'message' => 'Sesión cerrada correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo cerrar la sesión']);
}

?>