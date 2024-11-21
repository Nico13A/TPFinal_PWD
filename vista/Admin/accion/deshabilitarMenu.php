<?php
//header('Content-Type: application/json; charset=utf-8');
include_once("../../../configuracion.php");
$datos = data_submitted();
$obj = new ABMMenu();
if (isset($datos['id']) && isset($datos['tiempo'])) {
    $idMenu = $datos['id'];
    $tiempoActual = $datos['tiempo'];

    // Actualizar el estado del menu en la base de datos
    $resultado = $obj->DeshabilitarMenu($idMenu, $tiempoActual);

    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo deshabilitar el Menú.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para deshabilitar el Menú.']);
}


?>
