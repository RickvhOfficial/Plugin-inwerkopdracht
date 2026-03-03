<?php
/**
 * Block Name: Images with Heading Description
 * Description: Een blok met een titel, beschrijving en twee afbeeldingen in een responsive layout.
 * Category: custom-blocks
 * Icon: align-pull-left
 * Keywords: images, content, heading, description, two-column
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_images_with_heading_description_block');
}

function register_images_with_heading_description_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'images-with-heading-description',
            'title'             => __('Images with Heading Description', 'developing-theme'),
            'description'       => __('Een blok met een titel, beschrijving en twee afbeeldingen in een responsive layout.', 'developing-theme'),
            'render_template'   => 'resources/blocks/images-with-heading-description/images-with-heading-description.php',
            'category'          => 'custom-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array('images', 'content', 'heading', 'description', 'two-column'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'heading'           => 'We didn\'t reinvent the wheel',
                        'content'           => '<p>We are strategists, designers and developers. Innovators and problem solvers.</p>',
                        'is_preview'        => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_images_with_heading_description_fields');
}

function register_images_with_heading_description_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_images_with_heading_description',
        'title' => 'Images with Heading Description Instellingen',
        'fields' => array(
            array(
                'key' => 'field_iwhd_accordion_content',
                'label' => 'Images with Heading Description Instellingen',
                'name' => 'accordion_content_iwhd',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 1,
                'multi_expand' => 0,
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_iwhd_heading',
                'label' => 'Titel',
                'name' => 'heading',
                'type' => 'text',
                'instructions' => 'Voer de hoofdtitel in',
                'required' => 1,
                'default_value' => 'We didn\'t reinvent the wheel',
            ),
            array(
                'key' => 'field_iwhd_content',
                'label' => 'Inhoud',
                'name' => 'content',
                'type' => 'wysiwyg',
                'instructions' => 'Voer de hoofdinhoud in',
                'required' => 0,
                'default_value' => '<p class="mb-4">We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.</p><p>We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.</p>',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 0,
                'delay' => 0,
            ),
            array(
                'key' => 'field_iwhd_image_1',
                'label' => 'Afbeelding 1',
                'name' => 'image_1',
                'type' => 'image',
                'instructions' => 'Upload de eerste afbeelding (linksboven in het grid)',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => 'jpg, jpeg, png',
            ),
            array(
                'key' => 'field_iwhd_image_2',
                'label' => 'Afbeelding 2',
                'name' => 'image_2',
                'type' => 'image',
                'instructions' => 'Upload de tweede afbeelding (rechtsonder in het grid)',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => 'jpg, jpeg, png',
            ),
            array(
                'key' => 'field_iwhd_background_color',
                'label' => 'Achtergrondkleur',
                'name' => 'background_color',
                'type' => 'select',
                'instructions' => 'Kies de achtergrondkleur voor deze sectie',
                'required' => 0,
                'choices' => array(
                    'white' => 'Wit',
                    'gray' => 'Lichtgrijs',
                    'dark' => 'Donker',
                ),
                'default_value' => 'white',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_iwhd_reverse_layout',
                'label' => 'Layout omwisselen',
                'name' => 'reverse_layout',
                'type' => 'true_false',
                'instructions' => 'Zet de content rechts en de afbeeldingen links',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Ja',
                'ui_off_text' => 'Nee',
            ),
            array(
                'key' => 'field_iwhd_image_height',
                'label' => 'Vaste afbeeldingshoogte',
                'name' => 'image_height',
                'type' => 'number',
                'instructions' => 'Stel een vaste hoogte in voor de afbeeldingen (in pixels). Laat leeg voor automatische hoogte.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 300,
                'min' => 100,
                'max' => 800,
                'step' => 10,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'px',
            ),
            array(
                'key' => 'field_iwhd_accordion_content_endpoint',
                'label' => 'Images with Heading Description Endpoint',
                'name' => 'accordion_content_iwhd_endpoint',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 0,
                'multi_expand' => 0,
                'endpoint' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/images-with-heading-description',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
} 