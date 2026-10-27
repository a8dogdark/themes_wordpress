
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <nav class="navbar">

        <?php
            $logo_type = get_theme_mod('ssrl_navbar_logo_type', 'text');
            $logo_text = get_theme_mod('ssrl_navbar_logo_text', 'SSRL');
            $logo_id   = absint(get_theme_mod('ssrl_navbar_logo_image', 0));
            $logo_url  = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : false;
            ?>

            <a class="navbar-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php if ($logo_type === 'image' && $logo_url) : ?>
                    <img
                        src="<?php echo esc_url($logo_url); ?>"
                        alt="<?php echo esc_attr($logo_text ?: get_bloginfo('name')); ?>"
                    >
                <?php else : ?>
                    <?php echo esc_html($logo_text); ?>
                <?php endif; ?>
            </a>

        <button class="navbar-toggle"
                type="button"
                aria-label="Abrir menú"
                aria-expanded="false"
                aria-controls="primary-navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <?php
        wp_nav_menu([
            'theme_location'  => 'primary',
            'container'       => 'div',
            'container_class' => 'navbar-menu',
            'container_id'    => 'primary-navigation',
            'fallback_cb'     => 'wp_page_menu',
        ]);
        ?>

    </nav>
</header>
