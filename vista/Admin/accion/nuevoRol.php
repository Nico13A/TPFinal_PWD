<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$obj = new ABMRol();

if (isset($datos['rodescripcion'])) {
    $param['rodescripcion'] = $datos['rodescripcion'];
    $resultado = $obj->alta($param);
    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo crear el Rol.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para crear el Rol.']);
}


?>
