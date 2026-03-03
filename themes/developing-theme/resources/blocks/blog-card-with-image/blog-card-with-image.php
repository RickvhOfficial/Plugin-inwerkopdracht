<?php
/**
 * Blog Card with Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'blog-card-with-image-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and handle defaults
$section_title = get_field('section_title') ?: 'Laatste Berichten';
$section_background = get_field('section_background') ?: 'white';
$posts_per_row = get_field('posts_per_row') ?: '3';
$posts_per_page = get_field('posts_per_page') ?: 6;
$show_pagination = get_field('show_pagination');
$category_filter = get_field('category_filter');
$show_category = get_field('show_category');
$show_excerpt = get_field('show_excerpt');
$excerpt_length = get_field('excerpt_length') ?: 20;
$show_read_more = get_field('show_read_more');
$read_more_text = get_field('read_more_text') ?: 'Lees meer';

// Set background classes based on selection
$bg_classes = [
    'white' => 'bg-white',
    'gray' => 'bg-gray-50',
    'dark' => 'bg-gray-800 text-white'
];

// Set grid columns based on selection
$grid_columns = [
    '1' => 'grid-cols-1',
    '2' => 'sm:grid-cols-2',
    '3' => 'sm:grid-cols-2 lg:grid-cols-3',
    '4' => 'sm:grid-cols-2 lg:grid-cols-4'
];

// Get paged parameter for pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// WP Query arguments
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'ignore_sticky_posts' => true,
);

// Add category filter if selected
if ($category_filter) {
    $args['cat'] = $category_filter;
}

// The Query
$the_query = new WP_Query($args);

// Preview mode
if (isset($block['data']['is_preview']) && $block['data']['is_preview'] == true) : ?>
    <img src="<?= get_stylesheet_directory_uri(); ?>/resources/blocks/blog-card-with-image/preview.jpg" alt="Preview" style="width:100%; height:auto;">
<?php return;
endif;
?>

<section <?= $anchor; ?>class="<?= esc_attr($class_name); ?> <?= esc_attr($bg_classes[$section_background]); ?> py-16">
    <div class="container max-w-screen-xl mx-auto px-4 sm:px-6 lg:py-16 lg:px-6">
        <?php if ($section_title) : ?>
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="text-3xl font-bold mb-4 <?= $section_background === 'dark' ? 'text-white' : 'text-gray-900'; ?>">
                    <?= esc_html($section_title); ?>
                </h2>
            </div>
        <?php endif; ?>

        <?php if ($the_query->have_posts()) : ?>
            <div class="grid gap-8 <?= esc_attr($grid_columns[$posts_per_row]); ?>">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); 
                    // Get post categories
                    $categories = get_the_category();
                    $category = !empty($categories) ? $categories[0]->name : '';
                    $category_color = 'bg-primary-100 text-primary-800 dark:bg-primary-200 dark:text-primary-900';

                    // Get custom excerpt
                    $excerpt = wp_trim_words(get_the_excerpt(), $excerpt_length, '...');
                ?>
                    <article class="p-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col h-full">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="block mb-5">
                                <img class="rounded-lg w-full h-48 object-cover" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?= esc_attr(get_the_title()); ?>">
                            </a>
                        <?php endif; ?>

                        <?php if ($show_category && $category) : ?>
                            <span class="<?= $category_color; ?> text-xs font-semibold mr-2 px-2.5 py-0.5 rounded inline-block mb-2 w-fit">
                                <?= esc_html($category); ?>
                            </span>
                        <?php endif; ?>

                        <h2 class="my-2 text-xl font-bold tracking-tight <?= $section_background === 'dark' ? 'text-white' : 'text-gray-900'; ?>">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <?php if ($show_excerpt) : ?>
                            <p class="mb-4 font-light text-gray-500 dark:text-gray-400 flex-grow">
                                <?= esc_html($excerpt); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($show_read_more) : ?>
                            <div class="mt-auto">
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center font-medium text-primary-600 hover:underline">
                                    <?= esc_html($read_more_text); ?>
                                    <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php if ($show_pagination && $the_query->max_num_pages > 1) : ?>
                <nav class="flex justify-center mt-12">
                    <ul class="inline-flex items-center -space-x-px">
                        <?php
                        $big = 999999999; // need an unlikely integer
                        
                        // Vorige pagina
                        if ($paged > 1) : ?>
                            <li>
                                <a href="<?= get_pagenum_link($paged - 1) ?>" class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Vorige</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php
                        // Paginanummers
                        $total_pages = $the_query->max_num_pages;
                        $current = max(1, $paged);
                        $pagesToShow = 5;
                        $start = max(1, min($current - floor($pagesToShow / 2), $total_pages - $pagesToShow + 1));
                        $end = min($start + $pagesToShow - 1, $total_pages);
                        
                        for ($i = $start; $i <= $end; $i++) :
                            $isActive = ($i == $paged);
                            $pageClass = $isActive 
                                ? 'z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' 
                                : 'py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white';
                        ?>
                            <li>
                                <a href="<?= get_pagenum_link($i); ?>" aria-current="<?= $isActive ? 'page' : ''; ?>" class="<?= $pageClass; ?>">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php
                        // Volgende pagina
                        if ($paged < $the_query->max_num_pages) : ?>
                            <li>
                                <a href="<?= get_pagenum_link($paged + 1) ?>" class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Volgende</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        <?php else : ?>
            <div class="text-center p-8 <?= $section_background === 'dark' ? 'text-white' : 'text-gray-700'; ?>">
                <p>Geen berichten gevonden.</p>
            </div>
        <?php endif; ?>
        
        <?php wp_reset_postdata(); ?>
    </div>
</section>