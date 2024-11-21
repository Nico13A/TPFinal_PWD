$(document).ready(function () {
    async function agregarMenu(url, datos, modalId, exitoMensaje, errorMensaje) {
        try {
            const response = await $.ajax({
                type: "POST",
                url: url,
                data: datos,
                dataType: "json",
            });

            if (response.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: exitoMensaje,
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    $(modalId).modal("hide");
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
        } catch (error) {
            Swal.fire({
                title: "Error",
                text: errorMensaje,
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            })
        }
    }

    // Abre el modal
    $("#modal-menu").click(function () {
        $("#modal-menu").modal("show");
    });

    // Enviar el formulario
    $("#formulario-menu").submit(function (event) {
        event.preventDefault();
        let datos = $(this).serialize();
        // Llamar a la función agregarRol con el objeto
        agregarMenu(
            "./accion/nuevoMenu.php",
            datos, // Objeto con clave 'rodescripcion'
            "#modal-menu",
            "Nuevo Menú creado",
            "Hubo un problema con la conexión al servidor."
        );
    });
    
});
