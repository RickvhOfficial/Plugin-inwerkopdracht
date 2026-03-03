<?php
/**
 * Default Feature List Centered Template
 * 
 * Hoofdtemplate bestand voor het Default Feature List Centered blok.
 */
/* Template Name: Default Feature List Centered */
$header_title = get_field('header_title') ?: '';
$header_description = get_field('header_description') ?: '';
$features = get_field('features');

// Als er geen content is, toon niks
if (empty($header_title) && empty($header_description) && empty($features)) {
    return;
}
?>

<section class="bg-white dark:bg-gray-900 relative">
  <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6 relative z-10">
      <?php if (!empty($header_title) || !empty($header_description)): ?>
      <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
          <?php if (!empty($header_title)): ?>
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($header_title); ?></h2>
          <?php endif; ?>
          
          <?php if (!empty($header_description)): ?>
          <p class="text-gray-500 sm:text-xl dark:text-gray-400 font-light"><?php echo esc_html($header_description); ?></p>
          <?php endif; ?>
      </div>
      <?php endif; ?>
      
      <?php if (!empty($features)): ?>
      <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-12 md:space-y-0">
          <?php foreach($features as $feature): ?>
              <div class="text-center">
                  <div class="flex justify-center items-center mx-auto mb-4 w-10 h-10 rounded-xl bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                      <?php 
                      if(isset($feature['icon']) && !empty($feature['icon'])): 
                          $icon = $feature['icon'];
                          // Controleer of het een array is (afbeeldingsveld)
                          if(is_array($icon) && isset($icon['url'])):
                      ?>
                          <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? $feature['title']); ?>" class="w-5 h-5 lg:w-6 lg:h-6 object-contain">
                      <?php 
                          else:
                            // Eventuele SVG code tonen
                            echo $icon;
                          endif;
                      else: 
                      ?>
                          <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                      <?php endif; ?>
                  </div>
                  <?php if (!empty($feature['title'])): ?>
                  <h3 class="mb-2 text-xl font-bold dark:text-white"><?php echo esc_html($feature['title']); ?></h3>
                  <?php endif; ?>
                  
                  <?php if (!empty($feature['description'])): ?>
                  <p class="text-gray-500 dark:text-gray-400 font-light"><?php echo esc_html($feature['description']); ?></p>
                  <?php endif; ?>
              </div>
          <?php endforeach; ?>
      </div>
      <?php endif; ?>
  </div>
  
  <!-- Favicon als watermerk (verborgen op mobiel) -->
  <div class="absolute top-0 right-0 bottom-0 w-1/3 pointer-events-none opacity-5 z-0 hidden md:block" style="background-image: url('<?php echo esc_url(home_url('/wp-content/themes/developing-theme/includes/images/Favicon.png')); ?>'); background-repeat: no-repeat; background-position: right center; background-size: contain;"></div>
</section>