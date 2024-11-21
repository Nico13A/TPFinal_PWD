$(document).ready(function() {
    $("#formulario-inicio").submit(function(event) {
        event.preventDefault(); 
        
        let uspass = $("#uspass").val();  

        let passhash = CryptoJS.MD5(uspass).toString();
        $("#uspass").val(passhash);
        $.ajax({
            url: '../accion/verificarLogin.php',
            type: 'POST',
            data: $("#formulario-inicio").serialize(),
            success: function(response) {
                if(response.trim() === "Entro") {
                        window.location.href = "../home/index.php";
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Usuario o contraseña incorrectos.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema con la conexión al servidor.',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    });
});