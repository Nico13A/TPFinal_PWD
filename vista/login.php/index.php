<?php
//include_once("../Estructura/headerPublic.php");
include_once("../../configuracion.php");
$titulo = "Inicio";
?>
<script src="../../doc/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="../js/funciones.js"></script>
   
    <form action="" id="formularioInicio" enctype="multipart/form-data">
        <div class="flex-fill d-flex flex-column justify-content-center align-items-center text-black">
            <div class="error">
                <span>Datos de ingreso no válidos, por favor intente de nuevo.</span>
            </div>
            <div class="form-text">
                <h4>Inicio de sesión</h4>
            </div>
            <div class="mb-3 w-50">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="usmail" placeholder="correo@ejemplo.com" required>
            </div>
            <div class="mb-3 w-50">
                <label for="uspass" class="form-label">Contraseña</label>
                <input type="password" id="uspass" class="form-control" name="uspass" aria-describedby="passwordHelpBlock" required>
                <div id="passwordHelpBlock" class="form-text">
                    Su contraseña debe tener entre 4 y 10, contener letras y números, sin espacios, carácteres especiales, o emoji.
                </div>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <input type="submit" name="envio" class="btn btn-primary btn-block" value="Enviar" >
                <button type="button" class="btn btn-primary"><a href="../Home/index.php" class="text-white text-decoration-none">Volver</a></button>
            </div>
        </div>
    </form>
    <script>
    //funcion dentro del archivo funciones.js ubicado en la carpeta js
    IniciarSesion();
    // funcion de encriptar
    /*function encriptarPassword(){
        var password = document.getElementById("uspass").value;
        var passhash = CryptoJS.MD5(password).toString();
        document.getElementById("uspass").value = passhash;
        console.log("Contraseña encriptada:", passhash);

        setTimeout(function() {
        document.getElementById("formulario").submit();
    }, 100);
        return true;
    }*/
  </script>

<?php
//include_once("../Estructura/pie.php");
?>