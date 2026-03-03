<?php
/**
 * Block Name: Image CTA Button
 * Description: Een blok met afbeelding, tekst en een CTA-knop. Mogelijkheid voor meerdere rijen en keuze voor positie van de afbeelding.
 * Category: custom-blocks
 * Icon: align-pull-left
 * Keywords: image, cta, button, content, text
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_image_cta_button_block');
}

function register_image_cta_button_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'image-cta-button',
            'title'             => __('Image CTA Button', 'developing-theme'),
            'description'       => __('Een blok met afbeelding, tekst en een CTA-knop. Mogelijkheid voor meerdere rijen en keuze voor positie van de afbeelding.', 'developing-theme'),
            'render_template'   => 'resources/blocks/image-cta-button/image-cta-button.php',
            'category'          => 'custom-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array('image', 'cta', 'button', 'content', 'text'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview'   => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_image_cta_button_fields');
}

function register_image_cta_button_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_image_cta_button',
        'title' => 'Image CTA Button Instellingen',
        'fields' => array(
            array(
                'key' => 'field_icb_accordion',
                'label' => 'Image CTA Button Instellingen',
                'name' => 'accordion_icb',
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
                'key' => 'field_icb_general_tab',
                'label' => 'Algemene Instellingen',
                'name' => 'general_tab',
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
                'key' => 'field_icb_section_background',
                'label' => 'Achtergrondkleur',
                'name' => 'section_background',
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
                'key' => 'field_icb_spacing',
                'label' => 'Spacing tussen rijen',
                'name' => 'spacing',
                'type' => 'select',
                'instructions' => 'Kies de hoeveelheid ruimte tussen de rijen',
                'required' => 0,
                'choices' => array(
                    'small' => 'Klein',
                    'medium' => 'Middel',
                    'large' => 'Groot',
                ),
                'default_value' => 'medium',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_icb_content_tab',
                'label' => 'Content',
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
                'key' => 'field_icb_rows',
                'label' => 'Image CTA Rijen',
                'name' => 'rows',
                'type' => 'repeater',
                'instructions' => 'Voeg rijen toe met afbeelding, tekst en CTA-knop',
                'required' => 0,
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Rij toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_icb_row_image_position',
                        'label' => 'Afbeelding Positie',
                        'name' => 'image_position',
                        'type' => 'radio',
                        'instructions' => 'Kies aan welke kant de afbeelding moet staan',
                        'required' => 0,
                        'choices' => array(
                            'left' => 'Links',
                            'right' => 'Rechts',
                        ),
                        'default_value' => 'left',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_icb_row_image',
                        'label' => 'Afbeelding',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload de afbeelding',
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'mime_types' => 'jpg, jpeg, png, svg',
                    ),
                    array(
                        'key' => 'field_icb_row_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Voer de titel in',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_icb_row_content',
                        'label' => 'Inhoud',
                        'name' => 'content',
                        'type' => 'wysiwyg',
                        'instructions' => 'Voer de tekst in',
                        'required' => 0,
                        'tabs' => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 1,
                        'delay' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_icb_row_button_text',
                        'label' => 'Knop Tekst',
                        'name' => 'button_text',
                        'type' => 'text',
                        'instructions' => 'De tekst op de CTA-knop',
                        'required' => 0,
                        'default_value' => 'Meer informatie',
                    ),
                    array(
                        'key' => 'field_icb_row_button_url',
                        'label' => 'Knop URL',
                        'name' => 'button_url',
                        'type' => 'url',
                        'instructions' => 'De URL voor de CTA-knop',
                        'required' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_icb_accordion_endpoint',
                'label' => 'Image CTA Button Endpoint',
                'name' => 'accordion_icb_endpoint',
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
                    'value' => 'acf/image-cta-button',
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