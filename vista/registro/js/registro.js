$(document).ready(function() {
    $("#formulario-registro").submit(function(event) {
        event.preventDefault(); // Prevenir el envío tradicional del formulario

        let uspass = $("#usspass").val();
        let passhash = CryptoJS.MD5(uspass).toString();

        $("#usspass").val(passhash);
             $.ajax({
            url: './accion/accionRegistro.php',
            type: 'POST',
            data: $("#formulario-registro").serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'Entro') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        text: 'Registro Exitoso',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "../home/index.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Registro Fallido',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text:  response.message || 'Hubo un problema al conectar con el servidor.',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    });
});
