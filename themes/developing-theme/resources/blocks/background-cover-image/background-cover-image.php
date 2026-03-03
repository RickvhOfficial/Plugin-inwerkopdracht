<?php
/**
 * Background Cover Image Block Template.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'background-cover-image-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Controleer of we in preview mode zijn
$is_preview = isset($block['data']['is_preview']) && $block['data']['is_preview'];
$is_editor = defined('REST_REQUEST') && REST_REQUEST && isset($_GET['context']) && $_GET['context'] === 'edit';

// Load values and handle defaults.
$background_image_data = get_field('background_image');
$background_image = '';

// Bepaal het juiste formaat van de afbeelding (URL of ID)
if (!empty($background_image_data)) {
    if (is_array($background_image_data) && isset($background_image_data['url'])) {
        // Als het een array is, gebruik de URL sleutel
        $background_image = $background_image_data['url'];
    } elseif (is_numeric($background_image_data)) {
        // Als het een ID is, haal de URL op
        $background_image = wp_get_attachment_url($background_image_data);
    } else {
        // Anders is het waarschijnlijk al een URL
        $background_image = $background_image_data;
    }
}

$title = get_field('title') ?: 'Your title here...';
$description = get_field('description') ?: 'Your description here...';
$button_text = get_field('button_text');
$button_url = get_field('button_url');
$section_height = get_field('section_height') ?: '';

// Als we een achtergrondafbeelding hebben, stel deze in als inline style
$bg_style = '';
if ($background_image) {
    $bg_style = 'style="background-image: url(' . esc_url($background_image) . '); background-size: cover; background-position: center; background-repeat: no-repeat;';
    
    // Voeg de aangepaste hoogte toe aan de stijl als deze is ingesteld
    if (!empty($section_height)) {
        // Sectie hoogte is nu een numeriek veld, dus voeg 'px' direct toe
        $bg_style .= ' height: ' . esc_attr($section_height) . 'px;';
    }
    
    $bg_style .= '"';
}

// Als we in preview mode zijn en de gebruiker is de block aan het bewerken, toon een melding
if ($is_editor && $is_preview): ?>
    <div style="padding: 20px; background: #f0f0f0; text-align: center; color: #666;">
        <p><strong>Dit is een voorbeeld weergave van het Background Cover Image block.</strong></p>
        <p>De werkelijke inhoud wordt bewerkt in de instellingen van het block.</p>
    </div>
<?php return; endif; ?>

<section <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> bg-gray-600 bg-blend-multiply" <?php echo $bg_style; ?>>
    <div class="relative py-8 px-4 mx-auto max-w-screen-xl text-white lg:py-16 lg:px-6 z-1 h-full flex items-center justify-center">
        <div class="mx-auto mb-6 max-w-screen-lg text-center lg:mb-0">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl"><?php echo esc_html($title); ?></h1>
            <p class="mb-6  text-white lg:mb-8 font-light md:text-lg lg:text-xl"><?php echo esc_html($description); ?></p>
            
            <?php if ($button_text && $button_url) : ?>
            <div class="flex justify-center">
                <a href="<?php echo esc_url($button_url); ?>" class="inline-flex items-center py-3 px-5 font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-900 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <?php echo esc_html($button_text); ?>
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>