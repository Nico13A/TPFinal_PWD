$(document).ready(function () {
    async function agregarRol(url, datos, modalId, exitoMensaje, errorMensaje) {
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
    $("#add-rol").click(function () {
        $("#modal-rol").modal("show");
    });

    // Enviar el formulario
    $("#formRol").submit(function (event) {
        event.preventDefault();
        let datos = $(this).serialize();
        // Llamar a la función agregarRol con el objeto
        agregarRol(
            "./accion/nuevoRol.php",
            datos, // Objeto con clave 'rodescripcion'
            "#modal-rol",
            "Nuevo rol creado",
            "Hubo un problema con la conexión al servidor."
        );
    });
    
});
