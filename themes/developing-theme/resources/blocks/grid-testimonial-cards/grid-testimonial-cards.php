<?php
/**
 * Grid Testimonial Cards Template
 * 
 * Hoofdtemplate bestand voor het Grid Testimonial Cards blok.
 */
$header_title = get_field('header_title') ?: '';
$header_description = get_field('header_description') ?: '';
$testimonials = get_field('testimonials');
$grid_columns = get_field('grid_columns') ?: '3';

// Grid column classes bepalen op basis van aantal kolommen
$grid_class = 'lg:grid-cols-3'; // standaard 3 kolommen
if ($grid_columns == '1') {
    $grid_class = 'lg:grid-cols-1';
} elseif ($grid_columns == '2') {
    $grid_class = 'lg:grid-cols-2';
} elseif ($grid_columns == '4') {
    $grid_class = 'lg:grid-cols-4';
}

// Als er testimonials zijn, bereid ze voor in kolommen
$columns = [];
if ($testimonials && is_array($testimonials)) {
    $items_per_col = ceil(count($testimonials) / intval($grid_columns));
    
    // Verdeel de testimonials gelijkmatig over het aantal kolommen
    for ($i = 0; $i < intval($grid_columns); $i++) {
        $columns[$i] = array_slice($testimonials, $i * $items_per_col, $items_per_col);
    }
}

// Als er geen content is, toon niks
if (empty($header_title) && empty($header_description) && empty($testimonials)) {
    return;
}
?>

<section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <?php if (!empty($header_title) || !empty($header_description)): ?>
      <div class="mx-auto max-w-screen-md text-center">
          <?php if (!empty($header_title)): ?>
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($header_title); ?></h2>
          <?php endif; ?>
          
          <?php if (!empty($header_description)): ?>
          <p class="mb-8 font-light text-gray-500 sm:text-xl dark:text-gray-400 lg:mb-16"><?php echo esc_html($header_description); ?></p>
          <?php endif; ?>
      </div>
      <?php endif; ?>
      
      <?php if (!empty($columns)): ?>
      <div class="grid gap-8 <?php echo esc_attr($grid_class); ?>">
          <?php foreach ($columns as $column_testimonials): ?>
              <div class="space-y-6">
                  <?php foreach ($column_testimonials as $testimonial): ?>
                      <figure class="p-6 bg-gray-50 rounded dark:bg-gray-800">
                          <blockquote class="text-sm font-light text-gray-500 dark:text-gray-400">
                              <?php if (!empty($testimonial['title'])): ?>
                              <h3 class="text-lg tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($testimonial['title']); ?></h3>
                              <?php endif; ?>
                              
                              <?php if (!empty($testimonial['quote'])): ?>
                              <p class="my-4 font-light"><?php echo nl2br(esc_html($testimonial['quote'])); ?></p>
                              <?php endif; ?>
                          </blockquote>
                          <figcaption class="flex items-center space-x-3">
                              <?php if (isset($testimonial['image']) && !empty($testimonial['image'])): ?>
                                  <img class="w-9 h-9 rounded-full" src="<?php echo esc_url($testimonial['image']['url']); ?>" alt="<?php echo esc_attr($testimonial['image']['alt'] ?? $testimonial['name']); ?>">
                              <?php else: ?>
                                  <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                                      <?php echo esc_html(substr($testimonial['name'] ?? 'A', 0, 1)); ?>
                                  </div>
                              <?php endif; ?>
                              <div class="space-y-0.5 font-medium dark:text-white">
                                  <?php if (!empty($testimonial['name'])): ?>
                                  <div class="font-light"><?php echo esc_html($testimonial['name']); ?></div>
                                  <?php endif; ?>
                                  
                                  <?php if (!empty($testimonial['position'])): ?>
                                  <div class="text-sm font-light text-gray-500 dark:text-gray-400"><?php echo esc_html($testimonial['position']); ?></div>
                                  <?php endif; ?>
                              </div>
                          </figcaption>    
                      </figure>
                  <?php endforeach; ?>
              </div>
          <?php endforeach; ?>
      </div>
      <?php endif; ?>
  </div>
</section>