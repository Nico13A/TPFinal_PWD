<?php
$Titulo = "Code Wear - Compras";
include_once "../estructura/cabecera.php";

$objSession = new Session();
$resp = $objSession->validar();
if($resp) {
    if(($objSession->getRol()[0]->getObjRol()->getRoDescripcion()) == 'CLIENTE'){
        // es deposito, no se hace nada, continua con la navegacion
    }
    else {
        echo("<script>location.href = '../home/index.php';</script>");
    }

} else {
    echo("<script>location.href = '../home/index.php';</script>");
}

$objUsuario = $objSession->getUsuario();
$idUsuario = $objUsuario->getIdUsuario();

$controlCompra = new AbmCompra();
$controlCompraEstado = new AbmCompraEstado();
$controlCompraItem = new AbmCompraItem();

// Inicializamos el array de detallesCompra como un array vacío
$detallesCompra = [];

$comprasUsuario = $controlCompra->buscar(['idusuario' => $idUsuario]);

$respuesta = "";
$cant = count($comprasUsuario);

if ($cant > 0) {
    foreach ($comprasUsuario as $compra) {
        $idCompra = $compra->getIdCompra();
        $objCompraEdo = $controlCompraEstado->buscar(['idcompra' => $idCompra]);
        foreach ($objCompraEdo as $edo) {
            $fechaFin = $edo->getCeFechaFin();
            switch ($edo->getObjCompraEstadoTipo()->getIdCompraEstadoTipo()) {
                case '1':
                    $detallesCompra[] = [
                        "Id de compra" => $idCompra,
                        "Estado" => "Iniciada",
                        "Fecha de inicio" => $edo->getCeFechaIni(),
                        "Fecha fin" => $fechaFin
                    ];
                    break;
                case '2':
                    $detallesCompra[] = [
                        "Id de compra" => $idCompra,
                        "Estado" => "Aceptada",
                        "Fecha de inicio" => $edo->getCeFechaIni(),
                        "Fecha fin" => $fechaFin
                    ];
                    break;
                case '3':
                    $detallesCompra[] = [
                        "Id de compra" => $idCompra,
                        "Estado" => "Enviada",
                        "Fecha de inicio" => $edo->getCeFechaIni(),
                        "Fecha fin" => $fechaFin
                    ];
                    break;
                case '4':
                    $detallesCompra[] = [
                        "Id de compra" => $idCompra,
                        "Estado" => "Cancelada",
                        "Fecha de inicio" => $edo->getCeFechaIni(),
                        "Fecha fin" => $fechaFin
                    ];
                    break;
                default:
                    break;
            }
        }
    }
}
?>

<!-- Modal para mostrar compras -->
<h2 class="display-5 fw-normal text-center py-4">Detalles de compras</h2>

<?php
// Verificamos si hay detalles de compras
if (count($detallesCompra) > 0) {
?>
    <div class="container py-2 mb-4 contenedorTabla">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="align-middle" scope="col">ID Compra</th>
                    <th class="align-middle" scope="col">Estado</th>
                    <th class="align-middle" scope="col">Fecha de inicio</th>
                    <th class="align-middle" scope="col">Fecha fin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Imprimimos cada compra
                foreach ($detallesCompra as $detalle) {
                    echo '<tr>
                        <th class="align-middle" scope="row">' . $detalle["Id de compra"] . '</th>
                        <td class="align-middle">' . $detalle["Estado"] . '</td>
                        <td class="align-middle">' . $detalle["Fecha de inicio"] . '</td>
                        <td class="align-middle">' . $detalle["Fecha fin"] . '</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo '<div class="container py-2 mb-4 contenedorTabla">';
    echo "<h5 class='text-danger'>No tiene compras realizadas.</h5>";
    echo '</div>';
}
?>

<?php
include_once "../estructura/pie.php";
?>

