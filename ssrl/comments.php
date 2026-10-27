<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>

        <h2 class="comments-title">
            <?php
            printf(
                esc_html(_n(
                    '%s comentario',
                    '%s comentarios',
                    get_comments_number(),
                    'ssrl'
                )),
                number_format_i18n(get_comments_number())
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments([
                'style'      => 'ol',
                'avatar_size' => 48,
                'short_ping' => true,
                'reply_text' => 'Responder',
            ]);
            ?>
        </ol>

        <?php the_comments_pagination([
            'prev_text' => '← Anteriores',
            'next_text' => 'Siguientes →',
        ]); ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number()) : ?>
        <p>Los comentarios están cerrados.</p>
    <?php endif; ?>

    <?php
    comment_form([
        'title_reply'          => 'Deja un comentario',
        'label_submit'         => 'Publicar comentario',
        'comment_notes_before' => '<p>Tu correo electrónico no será publicado.</p>',
        'comment_notes_after'  => '',
        'class_submit'         => 'comment-submit',
    ]);
    ?>

</div>