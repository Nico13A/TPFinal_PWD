<?php
$Titulo = "Code Wear - Perfil usuario";
include_once "../estructura/cabecera.php";
// VALIDA SI LA SESION SIGUE ACTIVA o NO 
$obj = new Session();
$resp = $obj->validar();
if($resp) {
    //el usuario es valido, que rol tiene?
    if(($obj->getUsuario()->getIdUsuario()) == 1){
        // es admin, no se hace nada, continua con la navegacion
    }
    else{
        //header ('Location: href="../HomeLector/index.php');
        echo("<script>location.href = '../home/index.php';</script>");
    }
} else {
    //header ('Location: ../Inicio/index.php');
    echo("<script>location.href = '../sesion/iniciarSesion.php';</script>");
}
$datos = data_submitted();
$idUsuario = $_SESSION["idusuario"];
$obj = new ABMUsuario();
$datosUsuario = $obj->buscar("");
?>
<h2 class="display-5 fw-normal text-center py-4">Gestión de usuarios</h2>
<div class="container-fluid py-2 mb-4 contenedorTabla overflow-auto">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th class="align-middle" scope="col">ID</th>
                <th class="align-middle" scope="col">Usuario</th>
                <th class="align-middle" scope="col">Email</th>
                <th class="align-middle" scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datosUsuario as $objUsuario): ?>
                <tr>
                    <th class="align-middle" scope="row"><?php echo $objUsuario->getIdUsuario(); ?></th>
                    <td class="align-middle"><?php echo $objUsuario->getUsNombre(); ?></td>
                    <td class="align-middle"><?php echo $objUsuario->getUsMail(); ?></td>
                    <td class="align-middle">
                    <?php
                        if ($objUsuario->getUsDeshabilitado() == '0000-00-00 00:00:00') { //el usuario no esta deshabilitado
                            if($objUsuario->getIdUsuario() == '1'){
                                echo '<button class="btn btn-light" name="idusuario" onclick="deshabilitarUsuario(' . $objUsuario->getIdUsuario() . ')" disabled>Deshabilitar</button>';
                            }
                            else{
                                echo '<button class="btn btn-danger" name="idusuario" onclick="deshabilitarUsuario(' . $objUsuario->getIdUsuario() . ')">Deshabilitar</button>';
                            }
                        } else {
                            echo '<button class="btn btn-success" name="idusuario" onclick="HabilitarUsuario(' . $objUsuario->getIdUsuario() . ')">Habilitar</button>';
                        }
                    ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="./js/DeshabilitarUsuario.js"></script>
<script src="./js/HabilitarUsuario.js"></script>
<?php
include_once "../estructura/pie.php";
?>


