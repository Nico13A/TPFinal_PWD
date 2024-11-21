$(document).ready(function () {
    // Abre el modal
    $("#add-rol").click(function () {
        $("#modal-rol").modal("show");
    });

    // Enviar el formulario
    $("#formRol").submit(function (event) {
        event.preventDefault();
        let datos = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "./accion/nuevoRol.php",
            data: datos,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#modal-rol").modal("hide");
                    Swal.fire({
                        icon: "success",
                        title: "Éxito",
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(() => {
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
