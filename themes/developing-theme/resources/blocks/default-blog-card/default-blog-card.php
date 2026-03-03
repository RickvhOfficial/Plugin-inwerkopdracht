<?php
/**
 * Default Blog Card Template
 * 
 * Hoofdtemplate bestand voor het Default Blog Card blok.
 */
$header_title = get_field('header_title') ?: '';
$header_description = get_field('header_description') ?: '';

// Als er geen content is, toon niks
if (empty($header_title) && empty($header_description)) {
    return;
}

// Query voor de nieuwste 2 blogberichten
$recent_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
));
?>

<section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    <?php if (!empty($header_title) || !empty($header_description)): ?>
      <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
          <?php if (!empty($header_title)): ?>
          <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($header_title); ?></h2>
          <?php endif; ?>
          
          <?php if (!empty($header_description)): ?>
          <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400"><?php echo esc_html($header_description); ?></p>
          <?php endif; ?>
      </div>
    <?php endif; ?>
    
    <?php if ($recent_posts->have_posts()): ?>
      <div class="grid gap-8 lg:grid-cols-2">
        <?php while ($recent_posts->have_posts()): $recent_posts->the_post(); ?>
          <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-5 text-gray-500">
              <?php
              // Eerste categorie ophalen
              $categories = get_the_category();
              if (!empty($categories)) {
                  $category = $categories[0];
                  // Bepaal het icoon op basis van de categorienaam (je kunt dit aanpassen)
                  $icon = '<svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>';
              ?>
              <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                  <?php echo $icon; ?>
                  <?php echo esc_html($category->name); ?>
              </span>
              <?php } else { ?>
              <span></span> <!-- Lege span als er geen categorie is, om de layout te behouden -->
              <?php } ?>
              
              <span class="font-light text-sm">
                <?php 
                $post_date = get_the_date();
                $time_diff = human_time_diff(get_the_time('U'), current_time('timestamp'));
                echo esc_html($time_diff . ' ago'); 
                ?>
              </span>
            </div>
            
            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            
            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
              <?php 
              // Toon de samenvatting of een excerpt van de inhoud
              if (has_excerpt()) {
                  echo wp_trim_words(get_the_excerpt(), 30, '...');
              } else {
                  echo wp_trim_words(get_the_content(), 30, '...');
              }
              ?>
            </p>
            
            <a href="<?php the_permalink(); ?>" class="inline-flex items-center font-light text-primary-600 dark:text-primary-500 hover:underline">
              Lees meer
              <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </a>
          </article>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    <?php endif; ?>
  </div>
</section>