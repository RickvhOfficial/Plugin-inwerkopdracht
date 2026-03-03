<?php
/**
 * Overlay Cards with Zoom Template
 * 
 * Hoofdtemplate bestand voor het Overlay Cards with Zoom blok.
 */
$title = get_field('ocwz_title') ?: '';
$description = get_field('ocwz_description') ?: '';
$secondary_description = get_field('ocwz_secondary_description') ?: '';
$button = get_field('ocwz_button');
$cards = get_field('ocwz_cards');

// Als er geen content is, toon niks
if (empty($title) && empty($description) && empty($secondary_description) && empty($cards)) {
    return;
}
?>

<section class="bg-white dark:bg-gray-900 antialiased relative">
  <div class="max-w-screen-xl px-4 py-8 mx-auto lg:px-6 sm:py-16 lg:py-24 relative z-10">
    <div class="flex flex-col gap-8 sm:gap-12 md:flex-row md:items-start lg:gap-16">
      <div class="md:max-w-xs lg:max-w-sm">
        <?php if (!empty($title)): ?>
        <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-gray-900 sm:text-4xl dark:text-white">
          <?php echo esc_html($title); ?>
        </h2>
        <?php endif; ?>
        
        <?php if (!empty($description)): ?>
        <div class="mt-4 text-base font-light text-gray-500 sm:text-xl dark:text-gray-400" style="font-size: 18px;">
          <?php echo $description; ?>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($secondary_description)): ?>
        <div class="mt-4 text-base font-light text-gray-500 sm:text-xl dark:text-gray-400" style="font-size: 18px;">
          <?php echo $secondary_description; ?>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($button['text']) && !empty($button['url'])): ?>
        <div class="mt-4">
          <a href="<?php echo esc_url($button['url']); ?>" title=""
            class="text-white bg-primary-700 justify-center hover:bg-primary-800 inline-flex items-center focus:ring-4 focus:outline-none focus:ring-primary-300 font-light rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            role="button">
            <?php echo esc_html($button['text']); ?>
            <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd"
                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </a>
        </div>
        <?php endif; ?>
      </div>

      <?php if (!empty($cards)): ?>
      <div class="grid w-full grid-cols-1 gap-4 md:flex-1 shrink-0 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($cards as $card): ?>
        <div class="relative overflow-hidden rounded-lg group">
          <?php if (!empty($card['image'])): ?>
          <img class="object-cover w-full h-[320px] lg:h-[320px] scale-100 ease-in duration-300 group-hover:scale-125" 
               src="<?php echo esc_url($card['image']['url']); ?>" 
               alt="<?php echo esc_attr($card['image']['alt'] ?: $card['name']); ?>">
          <?php endif; ?>
          <div class="absolute inset-0 grid items-end justify-center p-4 bg-gradient-to-b from-transparent to-black/60">
            <div class="text-center">
              <?php if (!empty($card['name'])): ?>
              <p class="text-xl font-bold text-white">
                <?php echo esc_html($card['name']); ?>
              </p>
              <?php endif; ?>
              
              <?php if (!empty($card['position'])): ?>
              <p class="text-base font-light text-gray-300">
                <?php echo esc_html($card['position']); ?>
              </p>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  
  <!-- Favicon als watermerk (verborgen op mobiel) -->
  <div class="absolute top-0 left-52 bottom-0 w-1/3 pointer-events-none opacity-5 z-0 hidden md:block" style="background-image: url('<?php echo esc_url(home_url('/wp-content/themes/developing-theme/includes/images/Favicon.png')); ?>'); background-repeat: no-repeat; background-position: left center; background-size: contain;"></div>
</section>