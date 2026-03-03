<?php
/**
 * Default Contact Form Block Template.
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
$class_name = 'default-contact-form-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Load values and handle defaults.
$section_background = get_field('section_background') ?: 'white';
$heading = get_field('heading') ?: 'Contact Us';
$description = get_field('description') ?: 'Got a technical issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.';
$form_shortcode = get_field('form_shortcode');

// Bepaal de achtergrondklasse op basis van de selectie
$bg_class = '';
switch ($section_background) {
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

// Default form voor preview als we in preview modus zijn
if ($is_preview && empty($form_shortcode)) {
    $form_shortcode = '[gravityform id="1" title="false" description="false" ajax="true"]';
}

// Fallback in geval er geen shortcode is ingesteld
if (empty($form_shortcode)) {
    $form_shortcode = '<div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-center">
                          <p class="text-gray-500 dark:text-gray-400">Er is geen formulier shortcode ingesteld.</p>
                       </div>';
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($bg_class); ?>">
  <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
      <?php if ($heading) : ?>
      <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">
          <?php echo esc_html($heading); ?>
      </h2>
      <?php endif; ?>
      
      <?php if ($description) : ?>
      <div class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">
          <?php echo wp_kses_post($description); ?>
      </div>
      <?php endif; ?>
      
      <?php if (strpos($form_shortcode, '[') === 0) : ?>
          <?php echo do_shortcode($form_shortcode); ?>
      <?php else : ?>
          <?php echo wp_kses_post($form_shortcode); ?>
      <?php endif; ?>
  </div>
</section>