
<?php get_header(); ?>

<main class="single-news">
    <div class="single-news-container">

        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
        ?>

            <article <?php post_class('single-news-article'); ?>>

                <span class="single-news-category">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo esc_html($categories[0]->name);
                    }
                    ?>
                </span>

                <h1 class="single-news-title">
                    <?php the_title(); ?>
                </h1>

                <p class="single-news-date">
                    Publicado el <?php echo esc_html(get_the_date()); ?>
                </p>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-news-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="single-news-content">
                    <?php the_content(); ?>
                </div>

            </article>

        <?php
            endwhile;
        endif;
        ?>

    </div>
</main>

<?php get_footer(); ?>
