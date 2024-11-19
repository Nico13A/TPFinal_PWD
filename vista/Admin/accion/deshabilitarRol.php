<?php
//header('Content-Type: application/json; charset=utf-8');
include_once("../../../configuracion.php");
$datos = data_submitted();
$obj = new ABMRol();
if (isset($datos['idrol'])) {
    $idrol['idrol'] = $datos['idrol'];

    // Actualizar el estado del usuario en la base de datos
    $resultado = $obj->baja($idrol);

    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo dar de baja el rol.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para dar de baja el rol.']);
}


?>
