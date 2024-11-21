<?php
$Titulo = "Code Wear - Roles";
include_once "../estructura/cabecera.php";
// VALIDA SI LA SESION SIGUE ACTIVA o NO 
$obj = new Session();
$resp = $obj->validar();
if($resp) {
    if(($_SESSION['idusuario']) == 1){
        // es admin, no se hace nada, continua con la navegacion
    }
    else{
        echo("<script>location.href = '../home/index.php';</script>");
    }
} else {
    echo("<script>location.href = '../sesion/iniciarSesion.php';</script>");
}
$objRol = new ABMRol();
$roles = $objRol->buscar("");
?>

<h2 class="display-5 fw-normal text-center py-4">Nuevos Roles</h2>
<div class="container-fluid py-2 mb-4 contenedorTabla overflow-auto">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th class="align-middle" scope="col">ID</th>
                <th class="align-middle" scope="col">Descripción</th>
                <th class="align-middle" scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $tipoRoles): ?>
                <tr>
                    <th class="align-middle" scope="row"><?php echo $tipoRoles->getIdRol(); ?></th>
                    <td class="align-middle"><?php echo $tipoRoles->getRoDescripcion(); ?></td>
                    <td class="align-middle">
                    <?php
                    $rol = $tipoRoles->getIdRol();
                    if($rol == '1' || $rol == '2' || $rol == '3'){
                        echo '<button class="btn btn-light" name="idrol" onclick="bajaRol(' . $tipoRoles->getIdRol() . ')" disabled>Eliminar</button>';
                    }
                    else{
                        echo '<button class="btn btn-danger" name="idrol" onclick="bajaRol(' . $tipoRoles->getIdRol() . ')" >Eliminar</button>';
                    }
                    ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
    <div class="container">
    <input class="btn btn-success me-3" type="button" name="add-rol"  id="add-rol" value="Nuevo Rol" data-bs-toggle="modal" data-bs-target="#modal-rol">
    </div>

<script src="./js/DeshabilitarRoles.js"></script>
<script src="./js/AgregarRol.js"></script>

<?php
include_once "../estructura/pie.php";
include_once "modales.php";
?>


