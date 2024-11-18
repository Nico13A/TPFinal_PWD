<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$obj = new ABMUsuarioRol();

if (isset($datos['id'])) {
    $idUsuario = $datos['id'];

    $resultado = $obj->SwitchRol($idUsuario);
    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo cambiar el Rol del usuario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para habilitar el usuario.']);
}


?>
