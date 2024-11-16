<?php
//header('Content-Type: application/json; charset=utf-8');
include_once("../../../configuracion.php");
$datos = data_submitted();
$obj = new ABMUsuario();
if (isset($datos['id']) && isset($datos['tiempo'])) {
    $idUsuario = $datos['id'];
    $tiempoActual = $datos['tiempo'];

    // Actualizar el estado del usuario en la base de datos
    $resultado = $obj->Deshabilitar($idUsuario, $tiempoActual);

    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo deshabilitar el usuario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para deshabilitar el usuario.']);
}


?>
