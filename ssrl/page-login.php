
<?php
/* Template Name: Login SSRL */

if (is_user_logged_in()) {
    wp_safe_redirect(admin_url());
    exit;
}

get_header();
?>

<main class="login-page">
    <div class="login-box">
        <h1>Iniciar sesión</h1>
        <p>Accede a tu cuenta SSRL</p>

        <?php
        wp_login_form([
            'redirect'       => admin_url(),
            'label_username' => 'Usuario o correo',
            'label_password' => 'Contraseña',
            'label_remember' => 'Recordarme',
            'label_log_in'   => 'Ingresar',
            'remember'       => true,
        ]);
        ?>
    </div>
</main>

<?php get_footer(); ?>
