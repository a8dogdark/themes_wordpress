
document.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector('.navbar-toggle');
    const menu = document.querySelector('.navbar-menu');

    if (!button || !menu) return;

    button.addEventListener('click', function () {
        const isOpen = menu.classList.toggle('is-open');

        button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        button.setAttribute(
            'aria-label',
            isOpen ? 'Cerrar menú' : 'Abrir menú'
        );
    });
});
