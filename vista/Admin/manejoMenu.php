<?php
$Titulo = "Code Wear - Asignar Rol";
include_once "../estructura/cabecera.php";
// VALIDA SI LA SESION SIGUE ACTIVA o NO
$obj = new Session();
$resp = $obj->validar();
if($resp) {
    if(($obj->getUsuario()->getIdUsuario()) == 1){
    }
    else{
        echo("<script>location.href = '../home/index.php';</script>");
    }
} else {
    echo("<script>location.href = '../sesion/iniciarSesion.php';</script>");
}
$obj = new ABMMenu();
$menus = $obj->buscar("");
?>
<h2 class="display-5 fw-normal text-center py-4">Gestión de Menú</h2>
<div class="container-fluid py-2 mb-4 contenedorTabla overflow-auto">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th class="align-middle" scope="col">ID</th>
                <th class="align-middle" scope="col">Nombre</th>
                <th class="align-middle" scope="col">Descripción</th>
                <th class="align-middle" scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($menus as $objMenu): ?>
            <tr>
                <th class="align-middle" scope="row"><?php echo $objMenu->getIdMenu(); ?></th>
                <td class="align-middle"><?php echo $objMenu->getMeNombre(); ?></td>
                <td class="align-middle"><?php echo $objMenu->getMeDescripcion(); ?></td>
                <td class="align-middle">
                <?php 
                if ($objMenu->getMeDeshabilitado() == null) {
                    if($objMenu->getMeNombre()== 'Gestión de menú'){
                        echo '<button disabled class="btn btn-light" name="idmenu" onclick="deshabilitarMenu(' . $objMenu->getIdMenu() . ')">Deshabilitar</button>';
                    }
                    else{
                        echo '<button class="btn btn-danger" name="idmenu" onclick="deshabilitarMenu(' . $objMenu->getIdMenu() . ')">Deshabilitar</button>';
                    }
                } else {
                        echo '<button class="btn btn-success" name="idmenu" onclick="habilitarMenu(' . $objMenu->getIdMenu() . ')">Habilitar</button>';
                }
                ?>
                </td>
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <div class="container">
    <input class="btn btn-success me-3" type="button" name="add-rol"  id="add-rol" value="Nuevo Menú" data-bs-toggle="modal" data-bs-target="#modal-menu">
    </div>
</div>

<script src="./js/deshabilitarMenu.js"></script>
<script src="./js/habilitarMenu.js"></script>
<script src="./js/NuevoMenu.js"></script>
<?php
include_once("modales.php");
include_once "../estructura/pie.php";
?>


