<?php
/**
 * Block Name: Visual Image with Heading
 * Description: Een blok met een kop, tekst, knoppen en een afbeelding
 * Category: custom-blocks
 * Icon: format-image
 * Keywords: image, heading, text, visual, hero
 * Supports: { "align": false, "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_visual_image_with_heading_block');
}

function register_visual_image_with_heading_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'visual-image-with-heading',
            'title'             => __('Visual Image with Heading', 'developing-theme'),
            'description'       => __('Een blok met een kop, tekst, knoppen en een afbeelding', 'developing-theme'),
            'render_template'   => get_template_directory() . '/resources/blocks/visual-image-with-heading/visual-image-with-heading.php',
            'category'          => 'custom-blocks',
            'icon'              => 'format-image',
            'keywords'          => array('image', 'heading', 'text', 'visual', 'hero'),
            'supports'          => array(
                'anchor' => true,
                'align' => false,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'edit',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
        ));
    }

    // ACF Velden registreren
    if (function_exists('acf_add_local_field_group')) {
        register_visual_image_with_heading_fields();
    }
}

function register_visual_image_with_heading_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_visual_image_with_heading',
        'title' => 'Visual Image with Heading Instellingen',
        'fields' => array(
            array(
                'key' => 'field_viwh_accordion_content',
                'label' => 'Visual Image with Heading Instellingen',
                'name' => 'accordion_content_viwh',
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
                'key' => 'field_viwh_heading',
                'label' => 'Hoofdtitel',
                'name' => 'viwh_heading',
                'type' => 'text',
                'instructions' => 'De hoofdtitel van het blok',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_viwh_description',
                'label' => 'Beschrijving',
                'name' => 'viwh_description',
                'type' => 'wysiwyg',
                'instructions' => 'Een korte beschrijving onder de hoofdtitel',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_viwh_image',
                'label' => 'Afbeelding',
                'name' => 'viwh_image',
                'type' => 'image',
                'instructions' => 'De afbeelding die rechts wordt weergegeven',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_viwh_primary_button',
                'label' => 'Primaire knop',
                'name' => 'viwh_primary_button',
                'type' => 'group',
                'instructions' => 'Instellingen voor de primaire knop (optioneel)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_viwh_primary_button_text',
                        'label' => 'Tekst',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'De tekst die op de knop wordt weergegeven',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_viwh_primary_button_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                        'instructions' => 'De link waarnaar de knop verwijst',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_viwh_secondary_button',
                'label' => 'Secundaire knop',
                'name' => 'viwh_secondary_button',
                'type' => 'group',
                'instructions' => 'Instellingen voor de secundaire knop (optioneel)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_viwh_secondary_button_text',
                        'label' => 'Tekst',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'De tekst die op de knop wordt weergegeven',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_viwh_secondary_button_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                        'instructions' => 'De link waarnaar de knop verwijst',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_viwh_accordion_content_endpoint',
                'label' => 'Visual Image with Heading Endpoint',
                'name' => 'accordion_content_viwh_endpoint',
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
                    'value' => 'acf/visual-image-with-heading',
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
        'show_in_rest' => 0,
    ));
} 