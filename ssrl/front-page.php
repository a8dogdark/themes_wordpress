
<?php get_header(); ?>

<main class="home-page">
    

    
    <div class="hero-content">

        <?php
        $title_type = get_theme_mod('ssrl_hero_title_type', 'text');
        $main_title = get_theme_mod('ssrl_hero_main_title', 'RSX');
        $logo_id    = get_theme_mod('ssrl_hero_logo', 0);
        $logo_url   = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : false;
        ?>

        <?php if ($title_type === 'image' && $logo_url) : ?>
            <img
                class="hero-logo"
                src="<?php echo esc_url($logo_url); ?>"
                alt="<?php echo esc_attr($main_title); ?>"
            >
        <?php else : ?>
            <h1><?php echo esc_html($main_title); ?></h1>
        <?php endif; ?>

        <p class="hero-subtitle">
            <?php echo esc_html(get_theme_mod('ssrl_hero_small_title', 'REAL SIM EXPERIENCE')); ?>
        </p>

        <?php
        $text_count = min(5, max(1, absint(get_theme_mod('ssrl_text_count', 1))));

        for ($i = 1; $i <= $text_count; $i++) :
            $title = get_theme_mod("ssrl_hero_title_$i", '');
            $description = get_theme_mod("ssrl_hero_description_$i", '');
            $button = get_theme_mod("ssrl_hero_button_$i", '');
            $url = get_theme_mod("ssrl_hero_url_$i", '');

            if (!$title && !$description && !$button) {
                continue;
            }
        ?>

            <div class="hero-text-item <?php echo $i === 1 ? 'active' : ''; ?>">
                <?php if ($title) : ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="hero-description">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>

                <?php if ($button && $url) : ?>
                    <a class="hero-button hero-button-primary"
                    href="<?php echo esc_url($url); ?>">
                        <?php echo esc_html($button); ?>
                    </a>
                <?php endif; ?>
            </div>

        <?php endfor; ?>

    </div>


    <section class="hero-carousel">
        <?php
        $slides = [];

        for ($i = 1; $i <= 5; $i++) {
            $image_id = get_theme_mod("ssrl_slide_$i");

            if ($image_id) {
                $image_url = wp_get_attachment_image_url($image_id, 'full');

                if ($image_url) {
                    $slides[] = $image_url;
                }
            }
        }

        foreach ($slides as $index => $image_url) :
        ?>
            <div
                class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>"
                style="background-image: url('<?php echo esc_url($image_url); ?>');">
            </div>
        <?php endforeach; ?>

        <?php if (count($slides) > 1) : ?>
            <div class="hero-indicators">
                <?php foreach ($slides as $index => $image_url) : ?>
                    <div class="hero-indicator <?php echo $index === 0 ? 'active' : ''; ?>"></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    
    <section class="hero-stats">
        <div class="stat-item">
            <span class="stat-number">
                <?php
                $total_usuarios = count_users();
                echo esc_html(number_format_i18n($total_usuarios['total_users']));
                ?>
            </span>
            <span class="stat-label">PILOTOS</span>
        </div>

        <div class="stat-item">
            <span class="stat-number">
                <?php
                $categoria_equipos = get_category_by_slug('equipos');
                $total_equipos = 0;

                if ($categoria_equipos) {
                    $subcategorias = get_categories([
                        'taxonomy'   => 'category',
                        'parent'     => $categoria_equipos->term_id,
                        'hide_empty' => false,
                    ]);

                    $total_equipos = count($subcategorias);
                }

                echo esc_html(number_format_i18n($total_equipos));
                ?>
            </span>
            <span class="stat-label">EQUIPOS</span>
        </div>

        <div class="stat-item">
            <span class="stat-number">4</span>
            <span class="stat-label">CAMPEONATOS</span>
        </div>

        <div class="stat-item">
            <span class="stat-number">2</span>
            <span class="stat-label">SIMULADORES</span>
        </div>

        <div class="stat-item">
            <span class="stat-number">10</span>
            <span class="stat-label">CARRERAS</span>
        </div>
    </section>


    
    <section class="news-section">
        <div class="news-container">

            
            <div class="news-heading">
                <div class="news-heading-text">
                    <h2>Últimas noticias</h2>
                    <p>Entérate de las novedades de SSRL</p>
                </div>

                <?php
                    $total_noticias = wp_count_posts('post')->publish;
                    $categoria_noticias = get_category_by_slug('noticias');

                    if ($categoria_noticias) {
                        $consulta_total = new WP_Query([
                            'post_type'      => 'post',
                            'post_status'    => 'publish',
                            'cat'            => $categoria_noticias->term_id,
                            'posts_per_page' => 4,
                            'fields'         => 'ids',
                        ]);

                        if ($consulta_total->found_posts > 3) :
                    ?>
                        <a class="news-view-all" href="<?php echo esc_url(get_category_link($categoria_noticias->term_id)); ?>">
                            → Ver todo
                        </a>
                    <?php
                        endif;
                        wp_reset_postdata();
                    }
                    ?>
            </div>


            <div class="news-grid">
                <?php
                $noticias = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'category_name'  => 'noticias',
                    'post_status'    => 'publish',
                ]);

                if ($noticias->have_posts()) :
                    while ($noticias->have_posts()) :
                        $noticias->the_post();
                ?>
                    <article class="news-card">
                        <a class="news-card-link" href="<?php the_permalink(); ?>">
                            <div class="news-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php endif; ?>
                            </div>

                            <div class="news-content">
                                <span class="news-category">Noticias</span>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                                <span class="news-read-more">Leer más</span>
                            </div>
                        </a>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p>Todavía no hay noticias publicadas.</p>
                <?php endif; ?>
            </div>


        </div>
    </section>


</main>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.querySelector('.hero-carousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.hero-slide');
    const indicators = carousel.querySelectorAll('.hero-indicator');
    const texts = document.querySelectorAll('.hero-text-item');

    if (slides.length < 2 && texts.length < 2) return;

    let currentSlide = 0;
    let currentText = 0;

    function changeSlide() {
        if (slides.length > 0) {
            slides[currentSlide].classList.remove('active');
            indicators[currentSlide]?.classList.remove('active');

            currentSlide = (currentSlide + 1) % slides.length;

            slides[currentSlide].classList.add('active');
            indicators[currentSlide]?.classList.add('active');
        }

        if (texts.length > 1) {
            texts[currentText].classList.remove('active');

            currentText = (currentText + 1) % texts.length;

            texts[currentText].classList.add('active');
        }
    }

    if (slides.length > 1 || texts.length > 1) {
        setInterval(changeSlide, 5000);
    }
});
</script>


<?php get_footer(); ?>
