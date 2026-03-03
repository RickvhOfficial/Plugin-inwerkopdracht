<?php
/**
 * Contact Form with Location Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'contact-form-with-location-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Laad de veldwaarden
$section_background = get_field('section_background') ?: 'white';
$heading = get_field('heading') ?: 'Neem contact met ons op';
$gravity_form = get_field('gravity_form') ?: '[gravityform id="1" title="false" description="false"]';
$show_location = get_field('show_location');
$location_title = get_field('location_title') ?: 'Contactpunten';
$locations = get_field('locations') ?: [];
$contact_info = get_field('contact_info') ?: [];

// Achtergrondkleur klassen
$bg_class = 'bg-white dark:bg-gray-900';
$text_class = 'text-gray-900 dark:text-white';
$text_light_class = 'text-gray-500 dark:text-gray-400';

if ($section_background === 'gray') {
    $bg_class = 'bg-gray-50 dark:bg-gray-800';
    $text_class = 'text-gray-900 dark:text-white';
    $text_light_class = 'text-gray-500 dark:text-gray-400';
} elseif ($section_background === 'dark') {
    $bg_class = 'bg-gray-900 dark:bg-gray-900';
    $text_class = 'text-white dark:text-white';
    $text_light_class = 'text-gray-300 dark:text-gray-300';
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($bg_class); ?>">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="grid gap-16 <?php echo $show_location ? 'lg:grid-cols-3' : 'lg:grid-cols-1'; ?>">
            <?php if ($show_location) : ?>
            <div class="hidden lg:block">
                <?php if ($location_title) : ?>
                <h3 class="mb-4 text-lg font-semibold <?php echo esc_attr($text_class); ?>" style="font-size: 20px;"><?php echo esc_html($location_title); ?></h3>
                <?php endif; ?>
                
                <?php if ($locations && count($locations) > 0) : ?>
                    <?php foreach ($locations as $location) : ?>
                        <?php if (!empty($location['name'])) : ?>
                        <h4 class="mb-1 font-medium <?php echo esc_attr($text_class); ?>" style="font-size: 18px;"><?php echo esc_html($location['name']); ?></h4>
                        <?php endif; ?>
                        
                        <?php if (!empty($location['address'])) : ?>
                        <address class="text-sm font-light <?php echo esc_attr($text_light_class); ?> non-italic" style="font-size: 18px;">
                            <?php echo nl2br(esc_html($location['address'])); ?>
                        </address>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <?php if ($contact_info && count($contact_info) > 0) : ?>
                    <?php foreach ($contact_info as $contact) : ?>
                        <?php if (!empty($contact['title'])) : ?>
                        <h4 class="mt-4 mb-1 font-medium <?php echo esc_attr($text_class); ?>" style="font-size: 20px;"><?php echo esc_html($contact['title']); ?></h4>
                        <?php endif; ?>
                        
                        <?php if (!empty($contact['email'])) : ?>
                        <p class="text-sm font-light text-primary-600 hover:underline dark:text-primary-500" style="font-size: 18px;">
                            <a href="mailto:<?php echo esc_attr($contact['email']); ?>"><?php echo esc_html($contact['email']); ?></a>
                        </p>
                        <?php endif; ?>
                        
                        <?php if (!empty($contact['phone'])) : ?>
                        <p class="text-sm font-light text-primary-600 hover:underline dark:text-primary-500" style="font-size: 18px;">
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact['phone'])); ?>"><?php echo esc_html($contact['phone']); ?></a>
                        </p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <div class="<?php echo $show_location ? 'col-span-2' : 'col-span-1'; ?>">
                <?php if ($heading) : ?>
                <h2 class="mb-4 text-3xl tracking-tight font-extrabold <?php echo esc_attr($text_class); ?> lg:mb-8 md:text-4xl">
                    <?php echo esc_html($heading); ?>
                </h2>
                <?php endif; ?>
                
                <?php 
                // Gravity Form shortcode uitvoeren
                echo do_shortcode($gravity_form); 
                ?>
            </div>
        </div>
    </div>
</section>