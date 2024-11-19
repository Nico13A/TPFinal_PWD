<?php
$Titulo = "Code Wear - Asignar Rol";
include_once "../estructura/cabecera.php";
// VALIDA SI LA SESION SIGUE ACTIVA o NO
// -------- [SE PODRÍA MEJORAR CON UNA FUNCITON DE JAVA, QUE PREVENGA QUE LA PÁGINA CARGUE Y POR MIENTRAS VERIFIQUE] -------- 
$obj = new Session();
$resp = $obj->validar();
if($resp) {
    //el usuario es valido, que rol tiene?
    if(($_SESSION['idusuario']) == 1){
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
//Acá debería listar todos los usuarios de la bd usando ajax

$objUR = new ABMUsuarioRol();
$datosUsuarioRol = $objUR->buscar("");

?>

<h2 class="display-5 fw-normal text-center py-4">Gestión de Roles</h2>
<div class="container py-2 mb-4 contenedorTabla">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th class="align-middle" scope="col">ID</th>
                <th class="align-middle" scope="col">Usuario</th>
                <th class="align-middle" scope="col">Email</th>
                <th class="align-middle" scope="col">Rol</th>
                <th class="align-middle" scope="col">Descripción</th>
                <th class="align-middle" scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($datosUsuarioRol as $objURol): ?>
        <?php if ($objURol->getObjUsuario()->getUsDeshabilitado() == '0000-00-00 00:00:00'): ?>
            <tr>
                <th class="align-middle" scope="row"><?php echo $objURol->getObjUsuario()->getIdUsuario(); ?></th>
                <td class="align-middle"><?php echo $objURol->getObjUsuario()->getUsNombre(); ?></td>
                <td class="align-middle"><?php echo $objURol->getObjUsuario()->getUsMail(); ?></td>
                <td class="align-middle"><?php echo $objURol->getObjRol()->getIdRol(); ?></td>
                <td class="align-middle"><?php echo $objURol->getObjRol()->getRoDescripcion(); ?></td>
                <td class="align-middle">
                    <?php if ($objURol->getObjUsuario()->getIdUsuario() == '1'): ?>
                    <?php else: ?>
                        <button class="btn btn-success" name="idusuario" onclick="switchRol(<?php echo $objURol->getObjUsuario()->getIdUsuario(); ?>)">Cambiar</button>

                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="./js/switchRol.js"></script>

<?php
include_once "../estructura/pie.php";
?>


