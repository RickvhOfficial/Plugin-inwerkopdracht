<?php
/**
 * Content with Maps Block Template.
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
$class_name = 'content-with-maps-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Load values and handle defaults.
$section_background = get_field('section_background') ?: 'white';
$map_layout = get_field('map_layout') ?: 'below';
$heading = get_field('heading') ?: 'We didn\'t reinvent the wheel';
$description = get_field('description') ?: 'We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.';
$map_location = get_field('map_location') ?: 'Amsterdam,Netherlands';
$map_zoom = get_field('map_zoom') ?: '14';
$map_type = get_field('map_type') ?: 'place';
$map_height = get_field('map_height') ?: 400;

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

// Bouw de Google Maps URL op
$maps_url = 'https://www.google.com/maps/embed/v1/' . esc_attr($map_type) . '?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8';

// Het map container style met de aangepaste hoogte
$map_container_style = 'style="height: ' . esc_attr($map_height) . 'px;"';

if ($map_type === 'place') {
    $maps_url .= '&q=' . urlencode($map_location);
} elseif ($map_type === 'view') {
    $maps_url .= '&center=' . urlencode($map_location) . '&zoom=' . esc_attr($map_zoom);
}

// Preview mode
if (isset($block['data']['is_preview']) && $block['data']['is_preview'] == true) : ?>
    <img src="<?= get_stylesheet_directory_uri(); ?>/resources/blocks/content-with-maps/preview.jpg" alt="Preview" style="width:100%; height:auto;">
<?php return;
endif;
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($bg_class); ?>">
    <?php if ($map_layout === 'below') : ?>
        <!-- Layout: Kaart onder de tekst -->
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 sm:text-center">
            <?php if ($heading) : ?>
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                <?php echo esc_html($heading); ?>
            </h2>
            <?php endif; ?>
            
            <?php if ($description) : ?>
            <div class="font-light text-gray-500 sm:text-lg md:px-20 lg:px-38 xl:px-48 dark:text-gray-400">
                <?php echo wp_kses_post($description); ?>
            </div>
            <?php endif; ?>
            
            <div class="mx-auto mt-8 w-full max-w-2xl rounded-lg lg:mt-12 overflow-hidden" <?php echo $map_container_style; ?>>
                <!-- Google Maps embed met privacy-enhanced mode -->
                <iframe
                    class="w-full h-full border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="<?php echo esc_url($maps_url); ?>"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    <?php elseif ($map_layout === 'above') : ?>
        <!-- Layout: Kaart boven de tekst -->
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 sm:text-center">
            <div class="mx-auto mb-8 w-full max-w-2xl rounded-lg lg:mb-12 overflow-hidden" <?php echo $map_container_style; ?>>
                <!-- Google Maps embed met privacy-enhanced mode -->
                <iframe
                    class="w-full h-full border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="<?php echo esc_url($maps_url); ?>"
                    allowfullscreen>
                </iframe>
            </div>
            
            <?php if ($heading) : ?>
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                <?php echo esc_html($heading); ?>
            </h2>
            <?php endif; ?>
            
            <?php if ($description) : ?>
            <div class="font-light text-gray-500 sm:text-lg md:px-20 lg:px-38 xl:px-48 dark:text-gray-400">
                <?php echo wp_kses_post($description); ?>
            </div>
            <?php endif; ?>
        </div>
    <?php elseif ($map_layout === 'left') : ?>
        <!-- Layout: Kaart links naast de tekst -->
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center">
                <div class="w-full lg:w-1/2 rounded-lg overflow-hidden" <?php echo $map_container_style; ?>>
                    <!-- Google Maps embed met privacy-enhanced mode -->
                    <iframe
                        class="w-full h-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="<?php echo esc_url($maps_url); ?>"
                        allowfullscreen>
                    </iframe>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <?php if ($heading) : ?>
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        <?php echo esc_html($heading); ?>
                    </h2>
                    <?php endif; ?>
                    
                    <?php if ($description) : ?>
                    <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else : // right layout (standaard naast-de-tekst layout) ?>
        <!-- Layout: Kaart rechts naast de tekst -->
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center">
                <div class="w-full lg:w-1/2">
                    <?php if ($heading) : ?>
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        <?php echo esc_html($heading); ?>
                    </h2>
                    <?php endif; ?>
                    
                    <?php if ($description) : ?>
                    <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="w-full lg:w-1/2 rounded-lg overflow-hidden" <?php echo $map_container_style; ?>>
                    <!-- Google Maps embed met privacy-enhanced mode -->
                    <iframe
                        class="w-full h-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="<?php echo esc_url($maps_url); ?>"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>