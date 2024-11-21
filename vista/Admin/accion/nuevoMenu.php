<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$url = "";
$obj = new ABMMenu();
$objMenuRol = new ABMMenuRol();

if (isset($datos['idrol']) && isset($datos['menombre'])) {
    $param['menombre'] = $datos['menombre'];
    switch($datos['idrol']){    
        case '1': //es admin
            $url = "../Admin/". str_replace(" ", "", ucwords($datos['menombre'])).".php"; break;
        case '2': //es cliente
            $url = "../Cliente/". str_replace(" ", "", ucwords($datos['menombre'])).".php"; break;
        case '3': // es deposito
            $url = "../Deposito/". str_replace(" ", "", ucwords($datos['menombre'])).".php"; break;
    } 
    $param['medescripcion'] = $url;
    $param['idpadre'] = null;
    $resultado = $obj->alta($param);
    if ($resultado) {
        $parametro['idrol'] = $datos['idrol'];
        $aux['medescripcion'] = $url;
        $nuevoIdMenu = $obj->buscar($aux);
        $parametro['idmenu'] = $nuevoIdMenu[0]->getIdMenu();
        if($objMenuRol->alta($parametro)){
            echo json_encode(['success' => true]);
        }
        else{
            echo json_encode(['success' => false, 'message' => 'El menú fue creado pero no la relación.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo crear el Menú.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para crear el Menú.']);
}


?>
