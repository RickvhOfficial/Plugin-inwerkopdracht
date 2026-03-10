<?php

get_header();
?>

<main class="flex-1">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div>
                <?php the_content(); // Toont de content van de pagina
                ?>
            </div>
        <?php endwhile;
    else : ?>
        <p><?php esc_html_e('Sorry, no content found.'); ?></p>
    <?php
    endif;
    ?>
</main>

<?php
get_footer(); // Laad de footer
?>