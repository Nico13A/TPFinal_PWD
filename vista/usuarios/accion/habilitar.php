<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$obj = new ABMUsuario();

if (isset($datos['id'])) {
    $idUsuario = $datos['id'];

    $resultado = $obj->Habilitar($idUsuario);
    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo habilitar el usuario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para habilitar el usuario.']);
}


?>
