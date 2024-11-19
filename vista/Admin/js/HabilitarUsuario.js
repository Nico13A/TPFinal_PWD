function HabilitarUsuario(idUsuario) {

    $.ajax({
        url: './accion/habilitar.php',
        type: 'POST',
        data: { id: idUsuario },
    
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'El usuario fue habilitado correctamente.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload(); 
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Hubo un problema al habilitar el usuario.',
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
