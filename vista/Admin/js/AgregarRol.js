$(document).ready(function() {
    // Función para manejar el envío del formulario
    const descripcion = { descripcion: $('#descripcion').val() };

    async function agregarRol(url, descripcion, modalId, exitoMensaje, errorMensaje) {
        try {
            const response = await $.ajax({
                type: "POST",
                url: url,
                data: descripcion,
                dataType: 'json'
            });

            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: exitoMensaje,
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $(modalId).modal('hide');
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        } catch (error) {
            Swal.fire({
                title: 'Error',
                text: errorMensaje,
                icon: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        }
    }

    // Abre el modal
    $("#boton-rol").click(function() {
        $("#modalRol").modal('show');
    });


    // Enviar el formulario para cambiar contraseña.
    $("#formRol").submit(function(event) {
        event.preventDefault();
        let descripcion = $(this).serializeArray();
        });

        agregarRol(
            "./accion/nuevoRol.php",
            $.param(descripcion), // Convertir a string con formato query
            "#modalRol",
            "Nuevo rol creado",
            "Hubo un problema con la conexión al servidor."
        );
    });

    

