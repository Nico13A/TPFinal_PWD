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
                            </div>
                        </div>
                    </div>

        <?php       
                }
            }
        ?>
    </div>
</div>

<?php
include_once "../estructura/pie.php";
?>