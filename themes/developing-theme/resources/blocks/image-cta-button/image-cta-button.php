<?php
/**
 * Image CTA Button Block Template.
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
$class_name = 'image-cta-button-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and handle defaults.
$section_background = get_field('section_background') ?: 'white';
$spacing = get_field('spacing') ?: 'medium';
$rows = get_field('rows');

// Set background classes based on selection
$bg_classes = [
    'white' => 'bg-white',
    'gray' => 'bg-gray-50',
    'dark' => 'bg-gray-800 text-white'
];

// Set spacing classes based on selection
$spacing_classes = [
    'small' => 'space-y-8',
    'medium' => 'space-y-16',
    'large' => 'space-y-24'
];

// Preview mode
if (isset($block['data']['is_preview']) && $block['data']['is_preview'] == true) : ?>
    <img src="<?= get_stylesheet_directory_uri(); ?>/resources/blocks/image-cta-button/preview.jpg" alt="Preview" style="width:100%; height:auto;">
<?php return;
endif;
?>

<section <?= $anchor; ?>class="<?= esc_attr($class_name); ?> <?= esc_attr($bg_classes[$section_background]); ?> py-16">
    <div class="container max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if ($rows) : ?>
            <div class="<?= esc_attr($spacing_classes[$spacing]); ?>">
                <?php foreach ($rows as $index => $row) :
                    $image = $row['image'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $button_text = $row['button_text'];
                    $button_url = $row['button_url'];
                    $image_position = $row['image_position'] ?: 'left';
                ?>
                    <div class="flex flex-col md:flex-row items-center gap-8 <?= ($image_position == 'right') ? 'md:!flex-row-reverse' : ''; ?>">
                        <?php if ($image) : ?>
                            <div class="w-full md:w-1/2 mb-4 md:mb-0">
                                <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" class="w-full h-auto object-cover rounded-lg" />
                            </div>
                        <?php endif; ?>
                        
                        <div class="w-full md:w-1/2">
                            <?php if ($title) : ?>
                                <h2 class="text-3xl font-bold mb-4 <?= $section_background === 'dark' ? 'text-white' : 'text-gray-900'; ?>"><?= esc_html($title); ?></h2>
                            <?php endif; ?>
                            
                            <?php if ($content) : ?>
                                <div class="mb-6 font-light md:text-lg <?= $section_background === 'dark' ? 'text-gray-200' : 'text-gray-500'; ?>"><?= wp_kses_post($content); ?></div>
                            <?php endif; ?>
                            
                            <?php if ($button_text && $button_url) : ?>
                                <div class="mt-6">
                                    <a href="<?= esc_url($button_url); ?>" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 rounded-lg dark:focus:ring-primary-900">
                                        <?= esc_html($button_text); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>