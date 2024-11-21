document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('#modal-menu'); // Tu modal
    const mainContent = document.querySelector('main'); // El contenido principal
    const openModalButton = document.querySelector('#boton-rol'); // Botón que abre el modal
    const closeModalButton = modal.querySelector('.btn-close'); // Botón que cierra el modal

    function openModal() {
        // Ocultar contenido principal para lectores de pantalla
        mainContent.setAttribute('aria-hidden', 'true');

        // Mostrar el modal
        modal.classList.add('show');
        modal.removeAttribute('aria-hidden');

        // Pasar el foco al primer elemento interactivo dentro del modal
        const focusableElement = modal.querySelector('input, button, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusableElement) focusableElement.focus();
    }

    function closeModal() {
        // Restaurar la accesibilidad del contenido principal
        mainContent.removeAttribute('aria-hidden');

        // Ocultar el modal
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');

        // Devolver el foco al botón que abrió el modal
        openModalButton.focus();
    }

    openModalButton.addEventListener('click', openModal);
    closeModalButton.addEventListener('click', closeModal);

    // También manejar el cierre del modal con la tecla Escape
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('show')) {
            closeModal();
        }
    });
});