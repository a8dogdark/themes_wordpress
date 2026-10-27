<aside class="sidebar">

    <section class="sidebar-widget">
        <h3>Buscar</h3>
        <?php get_search_form(); ?>
    </section>

    <section class="sidebar-widget">
        <h3>Noticias recientes</h3>

        <ul>
            <?php
            $recent_posts = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 5,
                'post_status'    => 'publish',
            ]);

            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) :
                    $recent_posts->the_post();
            ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <li>No hay noticias disponibles.</li>
            <?php endif; ?>
        </ul>
    </section>

    <section class="sidebar-widget">
        <h3>Categorías</h3>

        <ul>
            <?php
            wp_list_categories([
                'title_li' => '',
                'show_count' => true,
            ]);
            ?>
        </ul>
    </section>

</aside>