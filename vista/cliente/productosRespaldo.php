<?php
$Titulo = "Code Wear - Productos";

include_once "../estructura/cabecera.php";

$datos = data_submitted();

$obj = new ABMProducto();
$lista = $obj->buscar(null);
?>

<h2 class="display-5 fw-normal text-center py-4">Productos</h2>
<div class="row float-left">
    <div class="col-md-12 float-left">
    <?php 
        if (isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
            echo $datos['msg'];
        }
    ?>
    </div>
</div>

<div class="container py-2 mb-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
            if(count($lista)>0) {
                foreach ($lista as $objTabla) {
        ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="<?php echo $URLIMAGEN . $objTabla->getUrlImagen(); ?>" class="card-img-top" alt="<?php echo $objTabla->getProNombre(); ?>">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?php echo $objTabla->getProNombre(); ?></h5>
                                <div class="d-flex gap-2 justify-content-center align-items-center py-4">
                                    <span class="fw-bold">Precio: </span>
                                    <span class="text-muted">$<?php echo $objTabla->getProPrecio(); ?></span>
                                </div>
                                <?php
                                    if ($objSession->validar()) {
                                ?>
                                    <div class="d-grid gap-3 d-md-flex justify-content-center">
                                        <button class="btn btn-warning d-flex justify-content-center align-items-center botonVer" type="button" data-id="<?php echo $objTabla->getIdProducto(); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

        <?php       
                }
            }
        ?>
    </div>
</div>

<!-- Modal producto detalle -->
<div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productoModalLabel">Detalles del producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <h3 id="product-name" class="text-center"></h3>
                <div class="d-flex align-items-center">
                    <img id="product-image" src="" alt="Imagen del producto" class="img-fluid me-3 imagen-producto-modal">
                    <div>
                        <p id="product-details"></p>
                        <p id="product-price"></p>
                        <p id="product-stock"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Input para seleccionar cantidad -->
                <div class="d-flex align-items-center me-3">
                    <label for="cantidadProducto" class="me-2">Cantidad:</label>
                    <input type="number" id="cantidadProducto" name="cantidadProducto" min="1" value="1" class="form-control" style="width: 80px;">
                </div>
                <button class="btn btn-success botonComprar" id="agregar-al-carrito">
                    Agregar al carrito
                </button>
                <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script src="./js/producto.js"></script>

<?php
include_once "../estructura/pie.php";
?>