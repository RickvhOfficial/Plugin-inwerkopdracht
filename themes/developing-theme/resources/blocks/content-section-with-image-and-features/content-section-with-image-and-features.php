<?php
/**
 * Block Template: Content Section with Image and Features
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value
$id = 'content-section-with-image-and-features-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values
$className = 'content-section-with-image-and-features';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults
$section_background = get_field('section_background') ?: 'white';
$logo = get_field('logo');
$logo_dark = get_field('logo_dark');
$header_links = get_field('header_links') ?: [];
$main_image = get_field('main_image');
$left_title = get_field('left_title') ?: 'Overview';
$left_content = get_field('left_content');
$features = get_field('features') ?: [];
$right_sections = get_field('right_sections') ?: [];

// Background class
$bg_class = 'bg-white dark:bg-gray-900';
if ($section_background === 'gray') {
    $bg_class = 'bg-gray-100 dark:bg-gray-800';
} elseif ($section_background === 'dark') {
    $bg_class = 'bg-gray-900 dark:bg-gray-900 text-white';
}

// Preview-specific settings
if (!empty($block['data']['is_preview'])) {
    echo '<img src="' . esc_url(get_template_directory_uri()) . '/resources/blocks/content-section-with-image-and-features/preview.jpg" alt="Preview" style="width:100%; height:auto;">';
    return;
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php echo esc_attr($bg_class); ?>">
  <div class="max-w-screen-xl px-4 py-8 mx-auto lg:px-6 sm:py-16 lg:py-24">
    <?php if ($logo || $logo_dark || !empty($header_links)): ?>
    <div class="text-center">
      <?php if ($logo): ?>
      <img class="object-contain w-80 mx-auto dark:hidden" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'Logo'); ?>">
      <?php endif; ?>

      <?php if (!empty($header_links)): ?>
      <div class="flex flex-col items-center justify-center gap-4 mt-4 sm:mt-5 sm:gap-8 sm:flex-row">
        <?php foreach ($header_links as $link): ?>
        <a href="<?php echo esc_url($link['url']); ?>" title="<?php echo esc_attr($link['text']); ?>"
          class="inline-flex items-center text-base font-semibold leading-tight text-primary-600 hover:underline dark:text-primary-500">
          <?php echo esc_html($link['text']); ?>
          <svg aria-hidden="true" class="w-4 h-4 ml-1.5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if ($main_image): ?>
    <div class="max-w-5xl mx-auto mt-8 lg:mt-16">
      <img class="w-full rounded-lg shadow-lg" src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt'] ?: 'Content image'); ?>">
    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 gap-8 mt-8 lg:gap-16 lg:grid-cols-2 lg:mt-16">
      <div>
        <div>
          <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">
            <?php echo esc_html($left_title); ?>
          </h3>
          <?php if ($left_content): ?>
          <p class="mt-2 font-light text-gray-500  md:text-lg dark:text-gray-400">
            <?php echo esc_html($left_content); ?>
          </p>
          <?php endif; ?>
        </div>

        <?php if (!empty($features)): ?>
        <ul class="grid grid-cols-1 mt-8 sm:grid-cols-2 gap-x-4 gap-y-3">
          <?php foreach ($features as $feature): ?>
          <li class="flex items-center gap-2.5">
            <svg class="w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
            </svg>
            <span class="text-base font-normal text-gray-500 dark:text-gray-400">
              <?php echo esc_html($feature['text']); ?>
            </span>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>

      <?php if (!empty($right_sections)): ?>
      <div class="space-y-8">
        <?php foreach ($right_sections as $section): ?>
        <div>
          <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">
            <?php echo esc_html($section['title']); ?>
          </h3>
          <p class="mt-2 font-light text-gray-500 md:text-lg dark:text-gray-400">
            <?php echo esc_html($section['content']); ?>
          </p>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>