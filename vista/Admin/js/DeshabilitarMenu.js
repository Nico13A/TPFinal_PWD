function deshabilitarMenu(idMenu) {

    // Generar el tiempo actual en formato ISO (YYYY-MM-DD HH:MM:SS)
    const tiempoActual = new Date().toISOString().slice(0, 19).replace('T', ' ');
    // Enviar solicitud AJAX

    $.ajax({
        url: './accion/deshabilitarMenu.php',
        type: 'POST',
        data: { id: idMenu, tiempo: tiempoActual },

        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'El Menú fue deshabilitado.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload(); 
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Hubo un problema al deshabilitar al Menú.',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema con la conexión al servidor.',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });

}
