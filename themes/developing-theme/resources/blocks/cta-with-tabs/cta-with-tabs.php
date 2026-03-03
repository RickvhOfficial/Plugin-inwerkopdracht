<?php
/**
 * Block Template: Afbeelding met Content
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value
$id = 'image-with-content-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values
$className = 'image-with-content';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults
$section_background = get_field('section_background') ?: 'white';
$content_sections = get_field('content_sections') ?: [];

// Background class
$bg_class = 'bg-white dark:bg-gray-900';
if ($section_background === 'gray') {
    $bg_class = 'bg-gray-100 dark:bg-gray-800';
} elseif ($section_background === 'dark') {
    $bg_class = 'bg-gray-900 dark:bg-gray-900 text-white';
}

// Preview-specific settings
if (!empty($block['data']['is_preview'])) {
    echo '<img src="' . esc_url(get_template_directory_uri()) . '/resources/blocks/cta-with-tabs/preview.jpg" alt="Preview" style="width:100%; height:auto;">';
    return;
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php echo esc_attr($bg_class); ?> antialiased">
  <div class="max-w-screen-xl px-4 py-8 mx-auto sm:py-16 lg:py-24">
    <?php if (!empty($content_sections)) : ?>
      <div class="space-y-16 sm:space-y-24 lg:space-y-32">
        <?php foreach ($content_sections as $index => $section) : 
          $image_position = $section['image_position'] ?: 'left';
          $image = $section['image'];
          $heading = $section['heading'];
          $description = $section['description'];
          $features = $section['features'] ?: [];
          $primary_button = $section['primary_button'] ?: [];
          $secondary_button = $section['secondary_button'] ?: [];
        ?>
          <div class="grid grid-cols-1 gap-8 lg:gap-16 lg:grid-cols-2 items-center">
            <!-- Content column -->
            <div class="space-y-4 sm:space-y-6 lg:space-y-8 flex flex-col justify-center <?php echo ($image_position === 'right') ? 'order-1 lg:order-1' : 'order-2 lg:order-2'; ?>">
              <?php if (!empty($heading)) : ?>
                <div>
                  <h2 class="text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl dark:text-white">
                    <?php echo esc_html($heading); ?>
                  </h2>
                  <?php if (!empty($description)) : ?>
                    <div class="mt-4 text-base font-light text-gray-500 dark:text-gray-400 sm:text-lg">
                      <?php echo wp_kses_post($description); ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if (!empty($features)) : ?>
                <div class="pt-4 border-t border-gray-200 sm:pt-6 lg:pt-8 dark:border-gray-800">
                  <ul class="space-y-4">
                    <?php foreach ($features as $feature) : ?>
                      <li class="flex items-center gap-2.5">
                        <div class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-primary-100 text-primary-600 shrink-0 dark:bg-primary-900 dark:text-primary-500">
                          <svg aria-hidden="true" class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                          </svg>
                        </div>
                        <span class="text-base font-light text-gray-900 dark:text-white">
                          <?php echo esc_html($feature['text']); ?>
                        </span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <?php if (!empty($primary_button['text']) || !empty($secondary_button['text'])) : ?>
                <div class="flex items-center gap-4">
                  <?php if (!empty($primary_button['text']) && !empty($primary_button['url'])) : ?>
                    <a href="<?php echo esc_url($primary_button['url']); ?>" title="<?php echo esc_attr($primary_button['text']); ?>" class="text-white bg-primary-700 justify-center hover:bg-primary-800 inline-flex items-center focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" role="button">
                      <?php echo esc_html($primary_button['text']); ?>
                      <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                    </a>
                  <?php endif; ?>

                  <?php if (!empty($secondary_button['text']) && !empty($secondary_button['url'])) : ?>
                    <a href="<?php echo esc_url($secondary_button['url']); ?>" title="<?php echo esc_attr($secondary_button['text']); ?>" class="px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" role="button">
                      <?php echo esc_html($secondary_button['text']); ?>
                    </a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>

            <!-- Image column -->
            <div class="<?php echo ($image_position === 'right') ? 'order-2 lg:order-2' : 'order-1 lg:order-1'; ?>">
              <?php if (!empty($image)) : ?>
                <?php echo wp_get_attachment_image($image['ID'], 'full', false, array('class' => 'w-full h-auto object-cover rounded-lg')); ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>