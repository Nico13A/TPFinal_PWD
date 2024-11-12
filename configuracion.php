<?php

    header('Content-Type: text/html; charset=utf-8');
    header ("Cache-Control: no-cache, must-revalidate ");

    /////////////////////////////
    //    CONFIGURACION APP    //
    /////////////////////////////
    
    //ubicacion de donde se encuentra el proyecto
    $PROYECTO = 'TPFinal_PWD/';

    //variable que almacena el directorio del proyecto
    $ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECTO/";

    include_once($ROOT . 'util/funciones.php');

    // Variable que define la pagina de autenticación del proyecto
    $PRINCIPAL = "Location:http://" . $_SERVER['HTTP_HOST'] . "/$PROYECTO/vista/home/index.php";

    // variable que define la pagina principal del proyecto (menu principal)
    //$INICIO = "Location:http://" . $_SERVER['HTTP_HOST'] . "/$PROYECTO/principal.php";

    $GLOBALS['ROOT'] = $ROOT;

?>