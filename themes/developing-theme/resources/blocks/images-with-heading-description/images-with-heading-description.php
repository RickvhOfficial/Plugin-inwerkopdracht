<?php
/**
 * Images with Heading Description Block Template.
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
$class_name = 'images-with-heading-description-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Load values and handle defaults.
$heading = get_field('heading') ?: 'We didn\'t reinvent the wheel';
$content = get_field('content') ?: '<p class="mb-4">We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.</p><p>We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.</p>';
$image_1 = get_field('image_1');
$image_2 = get_field('image_2');
$background_color = get_field('background_color') ?: 'white';
$reverse_layout = get_field('reverse_layout');
$image_height = get_field('image_height');

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

// Image height style
$image_height_style = '';
if ($image_height) {
    $image_height_style = 'height: ' . intval($image_height) . 'px;';
}

// Bepaal de volgorde van de kolommen op basis van de layout instelling
$content_order_class = $reverse_layout ? 'lg:order-last' : '';
$images_order_class = $reverse_layout ? 'lg:order-first' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($bg_class); ?>">
    <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
        <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400 <?php echo esc_attr($content_order_class); ?>">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($heading); ?></h2>
            <div class="mb-6 font-light text-gray-500 dark:text-gray-400 text-xl"><?php echo wp_kses_post($content); ?></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-8 <?php echo esc_attr($images_order_class); ?>">
            <?php if ($image_1) : 
                $image_1_url = $image_1['url'];
                $image_1_alt = $image_1['alt'] ?: 'Afbeelding 1';
            ?>
            <div class="w-full rounded-lg overflow-hidden" style="<?php echo esc_attr($image_height_style); ?>">
                <img class="w-full h-full object-cover rounded-lg" src="<?php echo esc_url($image_1_url); ?>" alt="<?php echo esc_attr($image_1_alt); ?>">
            </div>
            <?php else : ?>
            <div class="w-full rounded-lg bg-gray-100 dark:bg-gray-800 h-full flex items-center justify-center" style="<?php echo esc_attr($image_height_style ?: 'min-height: 200px;'); ?>">
                <span class="text-gray-400 dark:text-gray-600">Afbeelding 1</span>
            </div>
            <?php endif; ?>
            
            <?php if ($image_2) : 
                $image_2_url = $image_2['url'];
                $image_2_alt = $image_2['alt'] ?: 'Afbeelding 2';
            ?>
            <div class="mt-4 w-full lg:mt-10 rounded-lg overflow-hidden" style="<?php echo esc_attr($image_height_style); ?>">
                <img class="w-full h-full object-cover rounded-lg" src="<?php echo esc_url($image_2_url); ?>" alt="<?php echo esc_attr($image_2_alt); ?>">
            </div>
            <?php else : ?>
            <div class="mt-4 w-full lg:mt-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center" style="<?php echo esc_attr($image_height_style ?: 'min-height: 200px;'); ?>">
                <span class="text-gray-400 dark:text-gray-600">Afbeelding 2</span>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>