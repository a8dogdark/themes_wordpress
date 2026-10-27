<?php get_header(); ?>

<main class="error-404">
    <div class="error-404-content">
        <h1>404</h1>
        <h2>Página no encontrada</h2>
        <p>Lo sentimos, la página que buscas no existe o ha sido movida.</p>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-home">
            Volver al inicio
        </a>
    </div>
</main>

<?php get_footer(); ?>