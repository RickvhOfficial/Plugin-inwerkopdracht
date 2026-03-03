<?php
/**
 * Block Name: Background Cover Image
 * Description: Een block dat een sectie met achtergrondafbeelding en content weergeeft.
 * Category: custom-blocks
 * Icon: cover-image
 * Keywords: background, cover, image, hero
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_background_cover_image_block');
}

function register_background_cover_image_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'background-cover-image',
            'title'             => __('Background Cover Image', 'developing-theme'),
            'description'       => __('Een block dat een sectie met achtergrondafbeelding en content weergeeft.', 'developing-theme'),
            'render_template'   => 'resources/blocks/background-cover-image/background-cover-image.php',
            'category'          => 'custom-blocks',
            'icon'              => 'cover-image',
            'keywords'          => array('background', 'cover', 'image', 'hero'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'background_image'  => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/coast-house-view.jpg',
                        'title'             => 'We invest in the world\'s potential',
                        'description'       => 'The need for energy is universal. That\'s why we are pioneering new research and pursuing new technologies.',
                        'button_text'       => 'Learn more about the plan',
                        'button_url'        => '#',
                        'is_preview'        => true,
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_background_cover_image_fields');
}

function register_background_cover_image_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_background_cover_image',
        'title' => 'Background Cover Image Block',
        'fields' => array(
            array(
                'key' => 'field_bcimg_accordion_content',
                'label' => 'Background Cover Image Instellingen',
                'name' => 'accordion_content_bcimg',
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
                'key' => 'field_background_image',
                'label' => 'Achtergrondafbeelding',
                'name' => 'background_image',
                'type' => 'image',
                'instructions' => 'Kies een afbeelding voor de achtergrond',
                'required' => 1,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_title',
                'label' => 'Titel',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'Voer de titel in',
                'required' => 1,
            ),
            array(
                'key' => 'field_description',
                'label' => 'Beschrijving',
                'name' => 'description',
                'type' => 'textarea',
                'instructions' => 'Voer een beschrijving in',
                'required' => 1,
                'rows' => 4,
            ),
            array(
                'key' => 'field_button_text',
                'label' => 'Button Tekst',
                'name' => 'button_text',
                'type' => 'text',
                'instructions' => 'Tekst voor de button (optioneel)',
                'required' => 0,
            ),
            array(
                'key' => 'field_button_url',
                'label' => 'Button URL',
                'name' => 'button_url',
                'type' => 'url',
                'instructions' => 'Link voor de button (optioneel)',
                'required' => 0,
            ),
            array(
                'key' => 'field_section_height',
                'label' => 'Sectie Hoogte',
                'name' => 'section_height',
                'type' => 'number',
                'instructions' => 'Geef de hoogte op voor deze sectie in pixels. Laat leeg voor standaard hoogte.',
                'required' => 0,
                'default_value' => 400,
                'min' => 100,
                'max' => 1000,
                'step' => 10,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'px',
            ),
            array(
                'key' => 'field_bcimg_accordion_content_endpoint',
                'label' => 'Background Cover Image Endpoint',
                'name' => 'accordion_content_bcimg_endpoint',
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
                    'value' => 'acf/background-cover-image',
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