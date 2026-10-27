<?php get_header(); ?>

<?php if (has_post_thumbnail()) : ?>
    <div class="page-banner">
        <?php the_post_thumbnail('full'); ?>
    </div>
<?php endif; ?>

<main class="page-content">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>

            <div class="page-content-body">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>