<?php
$Titulo = "Code Wear - Control Compras";

include_once "../estructura/cabecera.php";
$obSession = new Session();
$resp = $objSession->validar();
if($resp) {
    if(($objSession->getRol()[0]->getObjRol()->getRoDescripcion()) == 'DEPOSITO'){
        // es deposito, no se hace nada, continua con la navegacion
    }
    else {
        echo("<script>location.href = '../home/index.php';</script>");
    }

} else {
    echo("<script>location.href = '../home/index.php';</script>");
}



$datos = data_submitted();

$obj = new ABMCompraEstado();
$lista = $obj->buscar(null);
?>

<div class="row float-left">
    <div class="col-md-12 float-left">
        <?php 
            if (isset($datos) && isset($datos['msg']) && $datos['msg'] != null) {
                echo $datos['msg'];
            }
        ?>
    </div>
</div>

<h2 class="display-5 fw-normal text-center py-4">Control de compras</h2>

<div class="container py-2 mb-4 contenedorTabla">
    <?php
    // Verificar si hay elementos en la lista antes de mostrar la tabla
    if (count($lista) > 0) {
    ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="align-middle" scope="col">ID Compra</th>
                    <th class="align-middle" scope="col">Estado</th>
                    <th class="align-middle" scope="col">Fecha Inicio</th>
                    <th class="align-middle" scope="col">Fecha Fin</th>
                    <th class="align-middle" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lista as $estadoCompra) {
                ?>
                    <tr>
                        <td class="align-middle"><?= $estadoCompra->getObjCompra()->getIdCompra() ?></td>
                        <td class="align-middle"><?= $estadoCompra->getObjCompraEstadoTipo()->getCetDescripcion() ?></td>
                        <td class="align-middle"><?= $estadoCompra->getCefechaini() ?></td>
                        <td class="align-middle"><?= $estadoCompra->getCefechafin() ?></td>
                        <td class="align-middle">
                            <button class="btn btn-secondary me-3 btnModificar" data-idcompraestado="<?= $estadoCompra->getIdCompraEstado() ?>">Modificar</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        // Mostrar mensaje cuando no hay registros
        echo '<h5 class="text-danger">No hay registros de estado de compras cargados.</h5>';
    }
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificarLabel">Modificar Estado de Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formModificarEstadoCompra">
                    <div class="mb-3">
                        <label for="cetdescripcion" class="form-label">Selecciona una opción</label>
                        <select class="form-select" id="cetdescripcion" required>
                            <option value="aceptada">Aceptar</option>
                            <option value="cancelada">Cancelar</option>
                            <option value="enviada">Enviar</option>
                        </select>
                    </div>
                    <input type="hidden" id="idcompraEstado" name="idcompraestado">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./js/modificarEstadoCompra.js"></script>

<?php
include_once "../estructura/pie.php";
?>
