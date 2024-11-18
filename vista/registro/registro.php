<?php
$Titulo = "Code Wear - Registro";
include_once("../estructura/cabecera.php");
?>

<div class="container py-5 form-container">
    <div class="row">
        <div class="col-3"></div>
        <form id="formulario-registro" name="formulario-registro" class="col-6 card p-4">
            <h2 class="text-center">Registrarse</h2>
            <div class="mb-3">
                <label for="usnombre" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usnombre" id="usnombre" required>
            </div>
            <div class="mb-3">
                <label for="uspass" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="uspass" id="uspass" required>
            </div>
            <div class="mb-3">
                <label for="usmail" class="form-label">Email</label>
                <input type="text" class="form-control" name="usmail" id="usmail" required>
            </div>
            <button type="submit" class="btn btn-success botonEnviar">Registrarse</button>

        </form>
        <div class="col-3"></div>
    </div>
</div>

<script src="./js/registro.js"></script>

<?php
include_once("../estructura/pie.php");
?>

