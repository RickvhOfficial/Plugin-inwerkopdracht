<?php
/**
 * Block Name: Carousel Slider
 * Description: Een blok met een titel en een carousel met afbeeldingen in een grid.
 * Category: custom-blocks
 * Icon: slides
 * Keywords: carousel, slider, images, gallery
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_carousel_slider_block');
}

function register_carousel_slider_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'carousel-slider',
            'title'             => __('Carousel Slider', 'developing-theme'),
            'description'       => __('Een blok met een titel en een carousel met afbeeldingen in een grid.', 'developing-theme'),
            'render_template'   => 'resources/blocks/carousel-slider/carousel-slider.php',
            'category'          => 'custom-blocks',
            'icon'              => 'slides',
            'keywords'          => array('carousel', 'slider', 'images', 'gallery'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'heading'           => 'Unwavering in our commitment to trust',
                        'link_text'         => 'Learn more about us',
                        'is_preview'        => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_carousel_slider_fields');
}

function register_carousel_slider_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_carousel_slider',
        'title' => 'Carousel Slider Instellingen',
        'fields' => array(
            array(
                'key' => 'field_cs_accordion',
                'label' => 'Carousel Slider Instellingen',
                'name' => 'accordion_cs',
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
                'key' => 'field_cs_content_tab',
                'label' => 'Content Instellingen',
                'name' => 'content_tab',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_cs_heading',
                'label' => 'Titel',
                'name' => 'heading',
                'type' => 'text',
                'instructions' => 'Voer de hoofdtitel in',
                'required' => 1,
                'default_value' => 'Unwavering in our commitment to trust',
            ),
            array(
                'key' => 'field_cs_link_text',
                'label' => 'Link Tekst',
                'name' => 'link_text',
                'type' => 'text',
                'instructions' => 'Tekst voor de link (optioneel)',
                'required' => 0,
                'default_value' => 'Learn more about us',
            ),
            array(
                'key' => 'field_cs_link_url',
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'url',
                'instructions' => 'URL voor de link (optioneel)',
                'required' => 0,
                'default_value' => '#',
            ),
            array(
                'key' => 'field_cs_background_color',
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
                'key' => 'field_cs_slider_tab',
                'label' => 'Carousel Slider Instellingen',
                'name' => 'slider_tab',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_cs_slides',
                'label' => 'Slides',
                'name' => 'slides',
                'type' => 'repeater',
                'instructions' => 'Voeg slides toe aan de carousel',
                'required' => 0,
                'min' => 1,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Slide toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cs_slide_image_1',
                        'label' => 'Afbeelding 1',
                        'name' => 'image_1',
                        'type' => 'image',
                        'instructions' => 'Upload de eerste afbeelding van de slide (links, altijd zichtbaar)',
                        'required' => 1,
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
                        'key' => 'field_cs_slide_image_2',
                        'label' => 'Afbeelding 2',
                        'name' => 'image_2',
                        'type' => 'image',
                        'instructions' => 'Upload de tweede afbeelding van de slide (rechts, alleen zichtbaar op desktop)',
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
                ),
            ),
            array(
                'key' => 'field_cs_accordion_endpoint',
                'label' => 'Carousel Slider Endpoint',
                'name' => 'accordion_cs_endpoint',
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
                    'value' => 'acf/carousel-slider',
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