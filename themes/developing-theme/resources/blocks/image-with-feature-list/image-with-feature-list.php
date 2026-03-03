<?php
/**
 * Image with Feature List Template
 * 
 * Hoofdtemplate bestand voor het Image with Feature List blok.
 */
$image = get_field('iwfl_image');
$image_height = get_field('iwfl_image_height');
$title = get_field('iwfl_title') ?: '';
$description = get_field('iwfl_description') ?: '';
$bottom_text = get_field('iwfl_bottom_text') ?: '';
$features = get_field('iwfl_features');

// Als er geen content is, toon niks
if (empty($image) && empty($title) && empty($description) && empty($features)) {
    return;
}

// Bereid de inline style voor als er een hoogte is ingesteld
$image_style = '';
if (!empty($image_height) && is_numeric($image_height)) {
    $image_style = 'height: ' . intval($image_height) . 'px; object-fit: cover;';
}
?>

<section class="bg-white dark:bg-gray-900">
  <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 xl:gap-16 sm:py-16 lg:px-6 ">
      <?php if (!empty($image)): ?>
      <img class="mb-4 w-full lg:mb-0 rounded-lg" 
           src="<?php echo esc_url($image['url']); ?>" 
           alt="<?php echo esc_attr($image['alt']); ?>"
           <?php echo !empty($image_style) ? 'style="' . $image_style . '"' : ''; ?>>
      <?php endif; ?>
      
      <div class="text-gray-500 dark:text-gray-400 sm:text-lg">
          <?php if (!empty($title)): ?>
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>
          
          <?php if (!empty($description)): ?>
          <p class="mb-8 font-light lg:text-lg"><?php echo esc_html($description); ?></p>
          <?php endif; ?>
          
          <?php if (!empty($features)): ?>
          <div class="py-8 mb-6 border-t border-b border-gray-200 dark:border-gray-700">
              <?php 
              $first = true;
              foreach ($features as $feature): 
                  $icon_color = !empty($feature['icon_color']) ? $feature['icon_color'] : 'primary';
                  $bg_classes = '';
                  $link_classes = '';
                  
                  // Bepaal de icoon kleurklassen op basis van de geselecteerde kleur
                  switch ($icon_color) {
                      case 'primary':
                          $bg_classes = 'bg-primary-100 dark:bg-primary-900';
                          $link_classes = 'text-primary-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-600';
                          break;
                      case 'purple':
                          $bg_classes = 'bg-purple-100 dark:bg-purple-900';
                          $link_classes = 'text-purple-600 hover:text-purple-800 dark:text-purple-500 dark:hover:text-purple-600';
                          break;
                      case 'teal':
                          $bg_classes = 'bg-teal-100 dark:bg-teal-900';
                          $link_classes = 'text-teal-600 hover:text-teal-800 dark:text-teal-500 dark:hover:text-teal-600';
                          break;
                      case 'green':
                          $bg_classes = 'bg-green-100 dark:bg-green-900';
                          $link_classes = 'text-green-600 hover:text-green-800 dark:text-green-500 dark:hover:text-green-600';
                          break;
                      case 'red':
                          $bg_classes = 'bg-red-100 dark:bg-red-900';
                          $link_classes = 'text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-600';
                          break;
                      case 'orange':
                          $bg_classes = 'bg-orange-100 dark:bg-orange-900';
                          $link_classes = 'text-orange-600 hover:text-orange-800 dark:text-orange-500 dark:hover:text-orange-600';
                          break;
                  }
              ?>
              <div class="flex <?php echo $first ? '' : 'pt-8'; ?>">
                  <div class="flex justify-center items-center mr-4 w-8 h-8 rounded-full <?php echo esc_attr($bg_classes); ?> shrink-0">
                      <?php if (!empty($feature['icon_image'])): ?>
                          <img src="<?php echo esc_url($feature['icon_image']['url']); ?>" 
                               alt="<?php echo esc_attr($feature['icon_image']['alt']); ?>"
                               class="w-5 h-5 object-contain">
                      <?php endif; ?>
                  </div>
                  <div>
                      <?php if (!empty($feature['title'])): ?>
                      <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white"><?php echo esc_html($feature['title']); ?></h3>
                      <?php endif; ?>
                      
                      <?php if (!empty($feature['description'])): ?>
                      <p class="mb-2 font-light text-gray-500 dark:text-gray-400 text-base"><?php echo esc_html($feature['description']); ?></p>
                      <?php endif; ?>
                      
                      <?php if (!empty($feature['link_text']) && !empty($feature['link_url'])): ?>
                      <a href="<?php echo esc_url($feature['link_url']); ?>" class="inline-flex items-center <?php echo esc_attr($link_classes); ?>">
                          <?php echo esc_html($feature['link_text']); ?>
                          <svg class="ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                      </a>
                      <?php endif; ?>
                  </div>
              </div>
              <?php 
                  $first = false;
                  endforeach; 
              ?>
          </div>
          <?php endif; ?>
          
          <?php if (!empty($bottom_text)): ?>
          <p class="text-sm"><?php echo esc_html($bottom_text); ?></p>
          <?php endif; ?>
      </div>
  </div>
</section>