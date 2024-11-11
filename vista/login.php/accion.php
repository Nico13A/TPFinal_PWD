<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$objUsuario = new ABMUsuario();
$resp = $objUsuario->UsuarioValido($datos);
echo $resp;
?>