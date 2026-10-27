<?php get_header(); ?>

<main class="archive-page">
    <div class="container">

        <header class="archive-header">
            <h1><?php echo esc_html(get_the_title(get_option('page_for_posts')) ?: 'Noticias'); ?></h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="archive-grid">

                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('archive-card'); ?>>

                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="archive-card-image">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        <?php endif; ?>

                        <div class="archive-card-content">
                            <span class="archive-date">
                                <?php echo esc_html(get_the_date()); ?>
                            </span>

                            <h2>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 25)); ?></p>

                            <a href="<?php the_permalink(); ?>" class="archive-read-more">
                                Leer más →
                            </a>
                        </div>

                    </article>
                <?php endwhile; ?>

            </div>

            <nav class="archive-pagination">
                <?php
                the_posts_pagination([
                    'prev_text' => '← Anterior',
                    'next_text' => 'Siguiente →',
                ]);
                ?>
            </nav>

        <?php else : ?>
            <p>Todavía no hay publicaciones.</p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>