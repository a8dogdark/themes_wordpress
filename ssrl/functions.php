<?php

function ssrl_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => 'Menú principal',
    ]);
}
add_action('after_setup_theme', 'ssrl_setup');


function ssrl_customize_register($wp_customize) {

    // LOGO DEL NAVBAR
    $wp_customize->add_section('ssrl_navbar_logo_section', [
        'title'    => 'Logo del navbar',
        'panel'    => 'nav_menus',
        'priority' => 5,
    ]);

    $wp_customize->add_setting('ssrl_navbar_logo_type', [
        'default'           => 'text',
        'sanitize_callback' => function ($value) {
            return in_array($value, ['text', 'image'], true) ? $value : 'text';
        },
    ]);

    $wp_customize->add_control('ssrl_navbar_logo_type', [
        'label'   => 'Tipo de logo',
        'section' => 'ssrl_navbar_logo_section',
        'type'    => 'select',
        'choices' => [
            'text'  => 'Texto',
            'image' => 'Imagen',
        ],
    ]);

    $wp_customize->add_setting('ssrl_navbar_logo_text', [
        'default'           => 'SSRL',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('ssrl_navbar_logo_text', [
        'label'           => 'Texto del logo',
        'section'         => 'ssrl_navbar_logo_section',
        'type'            => 'text',
        'active_callback' => function () {
            return get_theme_mod('ssrl_navbar_logo_type', 'text') === 'text';
        },
    ]);

    $wp_customize->add_setting('ssrl_navbar_logo_image', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Media_Control($wp_customize, 'ssrl_navbar_logo_image', [
            'label'           => 'Imagen del logo',
            'section'         => 'ssrl_navbar_logo_section',
            'mime_type'       => 'image',
            'active_callback' => function () {
                return get_theme_mod('ssrl_navbar_logo_type', 'text') === 'image';
            },
        ])
    );

    // CARRUSEL
    $wp_customize->add_panel('ssrl_carousel_panel', [
        'title'    => 'Carrusel',
        'priority' => 30,
    ]);

    $wp_customize->add_section('ssrl_carousel', [
        'title'    => 'Carrusel principal',
        'panel'    => 'ssrl_carousel_panel',
        'priority' => 10,
    ]);

    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("ssrl_slide_$i", [
            'default'           => '',
            'sanitize_callback' => 'absint',
        ]);

        $wp_customize->add_control(
            new WP_Customize_Media_Control($wp_customize, "ssrl_slide_$i", [
                'label'     => "Imagen $i",
                'section'   => 'ssrl_carousel',
                'mime_type' => 'image',
            ])
        );
    }

    // TÍTULOS DEL CARRUSEL
    $wp_customize->add_section('ssrl_hero_titles', [
        'title'    => 'Títulos principales del carrusel',
        'panel'    => 'ssrl_carousel_panel',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('ssrl_hero_main_title', [
        'default'           => 'RSX',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('ssrl_hero_main_title', [
        'label'           => 'Título grande',
        'section'         => 'ssrl_hero_titles',
        'type'            => 'text',
        'active_callback' => function () {
            return get_theme_mod('ssrl_hero_title_type', 'text') === 'text';
        },
    ]);

    $wp_customize->add_setting('ssrl_hero_small_title', [
        'default'           => 'REAL SIM EXPERIENCE',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('ssrl_hero_small_title', [
        'label'   => 'Título chico',
        'section' => 'ssrl_hero_titles',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('ssrl_hero_title_type', [
        'default'           => 'text',
        'sanitize_callback' => function ($value) {
            return in_array($value, ['text', 'image'], true) ? $value : 'text';
        },
    ]);

    $wp_customize->add_control('ssrl_hero_title_type', [
        'label'   => 'Tipo de título principal',
        'section' => 'ssrl_hero_titles',
        'type'    => 'select',
        'choices' => [
            'text'  => 'Texto (H1)',
            'image' => 'Imagen (logo)',
        ],
    ]);

    $wp_customize->add_setting('ssrl_hero_logo', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Media_Control($wp_customize, 'ssrl_hero_logo', [
            'label'     => 'Logo del título principal',
            'section'   => 'ssrl_hero_titles',
            'mime_type' => 'image',
        ])
    );
}
add_action('customize_register', 'ssrl_customize_register');


function ssrl_texts_customize_register($wp_customize) {
    $wp_customize->add_section('ssrl_hero_texts', [
        'title'    => 'Textos del carrusel',
        'panel'    => 'ssrl_carousel_panel',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('ssrl_text_count', [
        'default'           => 1,
        'sanitize_callback' => function ($value) {
            return min(5, max(1, absint($value)));
        },
    ]);

    $wp_customize->add_control('ssrl_text_count', [
        'label'   => 'Cantidad de textos',
        'section' => 'ssrl_hero_texts',
        'type'    => 'select',
        'choices' => [
            1 => '1 texto',
            2 => '2 textos',
            3 => '3 textos',
            4 => '4 textos',
            5 => '5 textos',
        ],
    ]);

    for ($i = 1; $i <= 5; $i++) {
        $fields = [
            "ssrl_hero_title_$i" => ['Título del texto ' . $i, 'text'],
            "ssrl_hero_description_$i" => ['Descripción del texto ' . $i, 'textarea'],
            "ssrl_hero_button_$i" => ['Texto del botón ' . $i, 'text'],
            "ssrl_hero_url_$i" => ['Enlace del botón ' . $i, 'url'],
        ];

        foreach ($fields as $setting_id => $field) {
            $wp_customize->add_setting($setting_id, [
                'default'           => '',
                'sanitize_callback' => $field[1] === 'url'
                    ? 'esc_url_raw'
                    : ($field[1] === 'textarea'
                        ? 'sanitize_textarea_field'
                        : 'sanitize_text_field'),
            ]);

            $wp_customize->add_control($setting_id, [
                'label'   => $field[0],
                'section' => 'ssrl_hero_texts',
                'type'    => $field[1],
            ]);
        }
    }
}
add_action('customize_register', 'ssrl_texts_customize_register');


function ssrl_enqueue_styles() {
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('ssrl-style', get_stylesheet_uri(), [], $version);

    $css_files = [
        'ssrl-base'       => 'base.css',
        'ssrl-header'     => 'header.css',
        'ssrl-hero'       => 'hero.css',
        'ssrl-stats'      => 'stats.css',
        'ssrl-news'       => 'news.css',
        'ssrl-footer'     => 'footer.css',
        'ssrl-login'      => 'login.css',
        'ssrl-responsive' => 'responsive.css',
        'ssrl-pages'      => 'pages.css',
    ];

    $previous_style = 'ssrl-style';

    foreach ($css_files as $handle => $file) {
        $path = get_theme_file_path('assets/css/' . $file);

        if (file_exists($path)) {
            wp_enqueue_style(
                $handle,
                get_theme_file_uri('assets/css/' . $file),
                [$previous_style],
                filemtime($path)
            );

            $previous_style = $handle;
        }
    }
}
add_action('wp_enqueue_scripts', 'ssrl_enqueue_styles');


function ssrl_mobile_menu_script() {
    $path = get_theme_file_path('assets/js/mobile-menu.js');

    if (file_exists($path)) {
        wp_enqueue_script(
            'ssrl-mobile-menu',
            get_theme_file_uri('assets/js/mobile-menu.js'),
            [],
            filemtime($path),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'ssrl_mobile_menu_script');

// ACTUALIZADOR NATIVO DEL TEMA DESDE GITHUB

function ssrl_github_theme_update($transient) {
    if (empty($transient->checked)) {
        return $transient;
    }

    $theme_slug = 'ssrl';
    $repo_api = 'https://api.github.com/repos/a8dogdark/themes_wordpress/releases/latest';

    $response = wp_remote_get($repo_api, [
        'timeout' => 15,
        'headers' => [
            'Accept' => 'application/vnd.github+json',
            'User-Agent' => 'WordPress-SSRL-Updater',
        ],
    ]);

    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
        return $transient;
    }

    $release = json_decode(wp_remote_retrieve_body($response));

    if (empty($release->tag_name) || empty($release->assets)) {
        return $transient;
    }

    $package_url = '';

    foreach ($release->assets as $asset) {
        if (!empty($asset->name) && $asset->name === 'ssrl.zip'
            && !empty($asset->browser_download_url)) {
            $package_url = $asset->browser_download_url;
            break;
        }
    }

    if (!$package_url) {
        return $transient;
    }

    $latest_version = ltrim($release->tag_name, 'v');
    $current_version = wp_get_theme($theme_slug)->get('Version');

    if (version_compare($latest_version, $current_version, '>')) {
        $transient->response[$theme_slug] = [
            'theme'        => $theme_slug,
            'new_version'  => $latest_version,
            'url'          => 'https://github.com/a8dogdark/themes_wordpress',
            'package'      => $package_url,
            'requires'     => '6.0',
            'requires_php' => '7.4',
        ];
    }

    return $transient;
}
add_filter('pre_set_site_transient_update_themes', 'ssrl_github_theme_update');
