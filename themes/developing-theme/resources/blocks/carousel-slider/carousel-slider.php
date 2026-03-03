<?php
/**
 * Carousel Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'carousel-slider-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Load values and handle defaults.
$heading = get_field('heading') ?: 'Unwavering in our commitment to trust';
$link_text = get_field('link_text');
$link_url = get_field('link_url');
$slides = get_field('slides');
$background_color = get_field('background_color') ?: 'white';

// Unieke ID voor deze carousel
$carousel_id = 'carousel-' . uniqid();

// Bepaal de achtergrondklasse op basis van de selectie
$bg_class = '';
switch ($background_color) {
    case 'gray':
        $bg_class = 'bg-gray-50 dark:bg-gray-800';
        break;
    case 'dark':
        $bg_class = 'bg-gray-900 text-white';
        break;
    default: // white
        $bg_class = 'bg-white dark:bg-gray-900';
        break;
}

// Als dit een preview is en er zijn geen slides, toon standaardslides
if ($is_preview && (!is_array($slides) || count($slides) === 0)) {
    $slides = [
        [
            'image_1' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/office-work.png', 'alt' => 'Office work'],
            'image_2' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/office.png', 'alt' => 'Office'],
        ],
        [
            'image_1' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/conference.png', 'alt' => 'Conference'],
            'image_2' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/girl-with-phone.png', 'alt' => 'Girl with phone'],
        ],
    ];
}

// Fallback slides indien nodig
if (!is_array($slides) || count($slides) === 0) {
    $slides = [
        [
            'image_1' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/office-work.png', 'alt' => 'Office work'],
            'image_2' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/office.png', 'alt' => 'Office'],
        ],
        [
            'image_1' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/conference.png', 'alt' => 'Conference'],
            'image_2' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/girl-with-phone.png', 'alt' => 'Girl with phone'],
        ],
        [
            'image_1' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/man-at-office.png', 'alt' => 'Man at office'],
            'image_2' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/meeting.png', 'alt' => 'Meeting'],
        ],
        [
            'image_1' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/work-from-home.png', 'alt' => 'Work from home'],
            'image_2' => ['url' => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/social-proof/carousel-slider/workspace.png', 'alt' => 'Workspace'],
        ],
    ];
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($bg_class); ?> lg:py-16 py-8">
  <div class="px-4 mx-auto mb-8 max-w-screen-md text-center md:mb-16 lg:px-0">
      <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-gray-900 md:text-4xl dark:text-white"><?php echo esc_html($heading); ?></h2>
      <?php if ($link_text && $link_url) : ?>
      <div>
          <a href="<?php echo esc_url($link_url); ?>" class="inline-flex justify-center items-center text-base font-medium text-primary-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-700">
              <?php echo esc_html($link_text); ?>
              <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
          </a>
      </div>
      <?php endif; ?>
  </div>
  <div class="mx-auto max-w-screen-xl">
      <div id="<?php echo esc_attr($carousel_id); ?>" class="relative px-16 sm:px-24" data-carousel="slide">
          <div class="overflow-hidden relative h-48 rounded-lg sm:h-64 xl:h-80 2xl:h-80">
              <?php foreach ($slides as $index => $slide) : 
                  $image_1 = isset($slide['image_1']) ? $slide['image_1'] : '';
                  $image_2 = isset($slide['image_2']) ? $slide['image_2'] : '';
                  
                  $image_1_url = is_array($image_1) && isset($image_1['url']) ? $image_1['url'] : '';
                  $image_1_alt = is_array($image_1) && isset($image_1['alt']) ? $image_1['alt'] : 'Slide image ' . ($index + 1);
                  
                  $image_2_url = is_array($image_2) && isset($image_2['url']) ? $image_2['url'] : '';
                  $image_2_alt = is_array($image_2) && isset($image_2['alt']) ? $image_2['alt'] : 'Slide image ' . ($index + 1) . ' - 2';
                  
                  // Alleen tonen als er tenminste één afbeelding is
                  if (!$image_1_url && !$image_2_url) continue;
                  
                  $active_class = $index === 0 ? '' : 'hidden';
              ?>
              <div class="grid <?php echo esc_attr($active_class); ?> absolute inset-0 gap-8 transition-all duration-700 ease-linear transform lg:grid-cols-2" data-carousel-item>
                  <?php if ($image_1_url) : ?>
                  <img src="<?php echo esc_url($image_1_url); ?>" class="block w-full h-full rounded-lg object-cover" alt="<?php echo esc_attr($image_1_alt); ?>">
                  <?php else : ?>
                  <div class="bg-gray-200 dark:bg-gray-700 rounded-lg w-full h-full flex items-center justify-center">
                      <span class="text-gray-500 dark:text-gray-400">Geen afbeelding</span>
                  </div>
                  <?php endif; ?>
                  
                  <?php if ($image_2_url) : ?>
                  <img src="<?php echo esc_url($image_2_url); ?>" class="hidden w-full h-full rounded-lg object-cover lg:block" alt="<?php echo esc_attr($image_2_alt); ?>">
                  <?php else : ?>
                  <div class="hidden lg:flex bg-gray-200 dark:bg-gray-700 rounded-lg w-full h-full items-center justify-center">
                      <span class="text-gray-500 dark:text-gray-400">Geen afbeelding</span>
                  </div>
                  <?php endif; ?>
              </div>
              <?php endforeach; ?>
          </div>
          <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
              <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 dark:bg-white/30 bg-gray-800/30 dark:group-hover:bg-white/50 group-hover:bg-gray-800/60 group-focus:ring-4 dark:group-focus:ring-white group-focus:ring-gray-800/70 group-focus:outline-none">
                  <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                  <span class="hidden">Vorige</span>
              </span>
          </button>
          <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
              <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 dark:bg-white/30 bg-gray-800/30 dark:group-hover:bg-white/50 group-hover:bg-gray-800/60 group-focus:ring-4 dark:group-focus:ring-white group-focus:ring-gray-800/70 group-focus:outline-none">
                  <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                  <span class="hidden">Volgende</span>
              </span>
          </button>
      </div> 
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiseer carousel
    const carousel = document.getElementById('<?php echo esc_attr($carousel_id); ?>');
    if (!carousel) return;
    
    const items = carousel.querySelectorAll('[data-carousel-item]');
    const prevBtn = carousel.querySelector('[data-carousel-prev]');
    const nextBtn = carousel.querySelector('[data-carousel-next]');
    
    let activeIndex = 0;
    
    // Functie om actieve slide te tonen met animatie
    function showSlide(index, direction = 'next') {
        // Huidig actieve slide
        const currentSlide = items[activeIndex];
        // Nieuwe slide
        const nextSlide = items[index];
        
        // Reset alle slides eerst
        items.forEach(item => {
            item.style.transform = '';
            item.classList.add('hidden');
        });
        
        // Bereid beide slides voor (huidige en volgende)
        currentSlide.classList.remove('hidden');
        nextSlide.classList.remove('hidden');
        
        // Stel startpositie in
        if (direction === 'next') {
            nextSlide.style.transform = 'translateX(100%)';
        } else {
            nextSlide.style.transform = 'translateX(-100%)';
        }
        
        // Forceer reflow voor animatie
        void nextSlide.offsetWidth;
        
        // Start animatie
        currentSlide.style.transition = 'transform 0.7s ease';
        nextSlide.style.transition = 'transform 0.7s ease';
        
        if (direction === 'next') {
            currentSlide.style.transform = 'translateX(-100%)';
        } else {
            currentSlide.style.transform = 'translateX(100%)';
        }
        nextSlide.style.transform = 'translateX(0)';
        
        // Update actieve index
        activeIndex = index;
        
        // Reset na animatie
        setTimeout(() => {
            items.forEach((item, i) => {
                if (i !== activeIndex) {
                    item.classList.add('hidden');
                    item.style.transition = '';
                    item.style.transform = '';
                }
            });
        }, 700); // Zelfde tijd als de duur van de animatie
    }
    
    // Event listeners voor navigatie
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            let newIndex = activeIndex - 1;
            if (newIndex < 0) newIndex = items.length - 1;
            showSlide(newIndex, 'prev');
            
            // Stop autoplay
            if (window.carouselInterval_<?php echo esc_attr($carousel_id); ?>) {
                clearInterval(window.carouselInterval_<?php echo esc_attr($carousel_id); ?>);
                window.carouselInterval_<?php echo esc_attr($carousel_id); ?> = null;
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            let newIndex = activeIndex + 1;
            if (newIndex >= items.length) newIndex = 0;
            showSlide(newIndex, 'next');
            
            // Stop autoplay
            if (window.carouselInterval_<?php echo esc_attr($carousel_id); ?>) {
                clearInterval(window.carouselInterval_<?php echo esc_attr($carousel_id); ?>);
                window.carouselInterval_<?php echo esc_attr($carousel_id); ?> = null;
            }
        });
    }
    
    // Toon eerste slide zonder animatie
    items.forEach((item, i) => {
        if (i === 0) {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });
    
    // Eenvoudige autoplay met vaste interval van 5 seconden
    const intervalTime = 5000; // 5 seconden
    window.carouselInterval_<?php echo esc_attr($carousel_id); ?> = setInterval(function() {
        if (!document.hidden) { // Alleen doorgaan als de pagina zichtbaar is
            let newIndex = activeIndex + 1;
            if (newIndex >= items.length) newIndex = 0;
            showSlide(newIndex, 'next');
        }
    }, intervalTime);
});
</script>