//este es un callback, que escucha el evento submit dentro del formulario con id="formularioInicio", este evento no es una funcion en si, no necesita ser llamado para su actuación.
//sin embargo, lo encapsulo dentro de la function IniciarSesion para que su funcionamiento sea mas independiente y pueda ser llamado en donde lo necesitemos
function IniciarSesion() {
    $(document).on('submit', '#formularioInicio', function(event) {
        event.preventDefault(); // Evita el envío del formulario
        
        $.ajax({
            url: 'accion.php',
            type: 'POST',
            data: $(this).serialize(), // Serializa los datos del formulario
            dataType: 'json', // Define que esperamos una respuesta JSON
            success: function(respuesta) {
                if (respuesta.error) {
                    console.error('Error:', respuesta.mensaje); // Muestra mensaje de error si existe
                } else {
                    console.log('Success:', respuesta.nombre); // Muestra el nombre del usuario si es válido
                }
            },

            error: function(error) {
                console.error('Error en la solicitud:', error); // Muestra cualquier otro error en la solicitud
            },
            complete: function() {
                console.log("Completado"); // Esto se ejecuta siempre al final
            }
        });
    });
}





