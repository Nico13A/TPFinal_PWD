<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$obj = new ABMMenu();

if (isset($datos['id'])) {
    $idMenu = $datos['id'];

    $resultado = $obj->Habilitar($idMenu);
    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo habilitar el usuario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para habilitar el usuario.']);
}


?>
