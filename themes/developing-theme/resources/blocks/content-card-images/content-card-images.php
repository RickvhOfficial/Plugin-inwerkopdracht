<?php
/**
 * Content Card Images Block Template.
 * Displays posts from the "aanbod" post type as cards.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'content-card-images-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Load values and handle defaults.
$heading = get_field('heading') ?: 'Ons aanbod';
$link_text = get_field('link_text');
$link_url = get_field('link_url');
$posts_per_page = get_field('posts_per_page') ?: 3;
$grid_columns = get_field('grid_columns') ?: 3;
$show_pagination = get_field('show_pagination');

// Beperk aantal kolommen tot maximaal 4
$grid_columns = min(4, $grid_columns);

// Bepaal de huidige pagina
$paged = 1;
if ($show_pagination) {
    $paged = isset($_GET['aanbod_page']) ? max(1, intval($_GET['aanbod_page'])) : 1;
}

// Query voor "aanbod" posts
$args = array(
    'post_type' => 'aanbod',
    'posts_per_page' => $posts_per_page,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
);

$aanbod_query = new WP_Query($args);

// Genereer een unieke ID voor deze block instance (nodig voor paginering)
$block_id = isset($block['id']) ? $block['id'] : 'cci-' . uniqid();
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?> bg-white dark:bg-gray-900" id="<?php echo esc_attr($block_id); ?>">
  <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <div class="text-center text-gray-900">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 lg:text-5xl dark:text-white"><?php echo esc_html($heading); ?></h2>
          <?php if ($link_text && $link_url) : ?>
          <a href="<?php echo esc_url($link_url); ?>" class="inline-flex items-center text-lg font-light text-primary-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-700">
              <?php echo esc_html($link_text); ?>
              <svg class="ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
          </a>
          <?php endif; ?>
      </div>
      
      <?php if ($aanbod_query->have_posts()) : ?>
      <div class="grid gap-6 mt-12 lg:mt-14 lg:gap-12 md:grid-cols-<?php echo esc_attr($grid_columns); ?>">
          <?php while ($aanbod_query->have_posts()) : $aanbod_query->the_post(); 
              // Featured image
              $image_id = get_post_thumbnail_id();
              if ($image_id) {
                  $image_url = wp_get_attachment_image_url($image_id, 'medium_large');
                  $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: get_the_title();
              } else {
                  // Fallback placeholder image
                  $image_url = 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%23cccccc\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-family=\'sans-serif\' font-size=\'24px\' fill=\'%23666666\'%3EGeen afbeelding%3C/text%3E%3C/svg%3E';
                  $image_alt = 'Geen afbeelding beschikbaar';
              }
              
              // Excerpt
              $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20, '...');
          ?>
          <div class="flex mb-2 md:flex-col md:mb-0 bg-white dark:bg-gray-800 p-5 rounded-lg shadow-sm">
              <a href="<?php the_permalink(); ?>" class="block w-full">
                <img class="mb-4 rounded-lg w-full h-64 object-cover" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                <div>
                    <h3 class="text-xl font-bold mb-2.5 text-gray-900 dark:text-white"><?php the_title(); ?></h3>
                    <p class="text-gray-500 dark:text-gray-400 font-light"><?php echo esc_html($excerpt); ?></p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-sm font-light text-primary-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-700">
                            Lees meer
                            <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        </span>
                    </div>
                </div>
              </a>
          </div>
          <?php endwhile; ?>
      </div>
      
      <?php if ($show_pagination && $aanbod_query->max_num_pages > 1) : ?>
      <div class="pagination-container mt-8 flex justify-center">
          <nav class="flex items-center" aria-label="Paginering">
              <ul class="inline-flex items-center -space-x-px">
                  <?php
                  $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                  $current_url = preg_replace('/[\?&]aanbod_page=[^&]+/', '', $current_url);
                  $current_url .= (parse_url($current_url, PHP_URL_QUERY) ? '&' : '?');
                  
                  // Vorige pagina
                  if ($paged > 1) {
                      $prev_page = $paged - 1;
                      echo '<li>';
                      echo '<a href="' . esc_url($current_url . 'aanbod_page=' . $prev_page) . '#' . esc_attr($block_id) . '" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white font-light">';
                      echo '<span class="sr-only font-light">Vorige</span>';
                      echo '<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>';
                      echo '</a>';
                      echo '</li>';
                  }
                  
                  // Paginanummers
                  for ($i = 1; $i <= $aanbod_query->max_num_pages; $i++) {
                      echo '<li>';
                      if ($i == $paged) {
                          echo '<a href="#" aria-current="page" class="z-10 px-3 py-2 leading-tight text-primary-600 border border-primary-300 bg-primary-50 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white font-light">' . $i . '</a>';
                      } else {
                          echo '<a href="' . esc_url($current_url . 'aanbod_page=' . $i) . '#' . esc_attr($block_id) . '" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white font-light">' . $i . '</a>';
                      }
                      echo '</li>';
                  }
                  
                  // Volgende pagina
                  if ($paged < $aanbod_query->max_num_pages) {
                      $next_page = $paged + 1;
                      echo '<li>';
                      echo '<a href="' . esc_url($current_url . 'aanbod_page=' . $next_page) . '#' . esc_attr($block_id) . '" class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white font-light">';
                      echo '<span class="sr-only font-light">Volgende</span>';
                      echo '<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>';
                      echo '</a>';
                      echo '</li>';
                  }
                  ?>
              </ul>
          </nav>
      </div>
      <?php endif; ?>
      
      <?php else : ?>
      <div class="text-center mt-8 p-8 bg-gray-50 dark:bg-gray-800 rounded-lg">
          <p class="text-gray-500 dark:text-gray-400 font-light">Er zijn momenteel geen aanbod items beschikbaar.</p>
      </div>
      <?php endif; 
      wp_reset_postdata(); // Reset de post data
      ?>
  </div>
</section>