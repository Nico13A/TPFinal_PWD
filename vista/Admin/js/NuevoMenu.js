$(document).ready(function () {
    // Abre el modal
    $("#modal-menu").click(function () {
        $("#modal-menu").modal("show");
    });

    // Enviar el formulario
    $("#formulario-menu").submit(function (event) {
        event.preventDefault();
        let datos = $(this).serialize();
        
        $.ajax({
            type: "POST",
            url: "./accion/nuevoMenu.php",
            data: datos,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Nuevo Menú creado",
                        text: response.message || 'Operación exitosa.',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        $("#modal-menu").modal("hide");
                        location.reload(); 
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema con la conexión al servidor.",
                    icon: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
        });
    });
});
