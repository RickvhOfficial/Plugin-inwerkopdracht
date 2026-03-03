<?php
/**
 * Block Name: Content Section with Image and Features
 * Description: Een inhoudssectie met een afbeelding, tekst en functiekenmerken.
 * Category: custom-blocks
 * Icon: align-center
 * Keywords: content, image, features, lijst, tekst
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_content_section_with_image_and_features_block');
}

function register_content_section_with_image_and_features_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'content-section-with-image-and-features',
            'title'             => __('Content Section with Image and Features', 'developing-theme'),
            'description'       => __('Een inhoudssectie met een afbeelding, tekst en functiekenmerken.', 'developing-theme'),
            'render_template'   => 'resources/blocks/content-section-with-image-and-features/content-section-with-image-and-features.php',
            'category'          => 'custom-blocks',
            'icon'              => 'align-center',
            'keywords'          => array('content', 'image', 'features', 'lijst', 'tekst'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_content_section_with_image_and_features_fields');
}

function register_content_section_with_image_and_features_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_content_section_with_image_and_features',
        'title' => 'Content Section with Image and Features Instellingen',
        'fields' => array(
            array(
                'key' => 'field_csif_accordion',
                'label' => 'Content Section with Image and Features Instellingen',
                'name' => 'accordion_csif',
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
                'key' => 'field_csif_general_tab',
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
                'key' => 'field_csif_section_background',
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
                'key' => 'field_csif_header_tab',
                'label' => 'Header Instellingen',
                'name' => 'header_tab',
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
                'key' => 'field_csif_logo',
                'label' => 'Logo',
                'name' => 'logo',
                'type' => 'image',
                'instructions' => 'Upload het hoofdlogo (optioneel)',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_csif_links',
                'label' => 'Header Links',
                'name' => 'header_links',
                'type' => 'repeater',
                'instructions' => 'Voeg links toe voor in de header (optioneel)',
                'required' => 0,
                'min' => 0,
                'max' => 4,
                'layout' => 'block',
                'button_label' => 'Link toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_csif_link_text',
                        'label' => 'Link Tekst',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'De tekst voor de link',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_csif_link_url',
                        'label' => 'Link URL',
                        'name' => 'url',
                        'type' => 'url',
                        'instructions' => 'De URL voor de link',
                        'required' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_csif_content_tab',
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
                'key' => 'field_csif_main_image',
                'label' => 'Hoofdafbeelding',
                'name' => 'main_image',
                'type' => 'image',
                'instructions' => 'Upload de hoofdafbeelding',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_csif_left_column_tab',
                'label' => 'Linker Kolom',
                'name' => 'left_column_tab',
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
                'key' => 'field_csif_left_title',
                'label' => 'Titel Linker Kolom',
                'name' => 'left_title',
                'type' => 'text',
                'instructions' => 'De titel voor de linker kolom',
                'required' => 0,
                'default_value' => 'Overview',
            ),
            array(
                'key' => 'field_csif_left_content',
                'label' => 'Inhoud Linker Kolom',
                'name' => 'left_content',
                'type' => 'textarea',
                'instructions' => 'De inhoud voor de linker kolom',
                'required' => 0,
            ),
            array(
                'key' => 'field_csif_features',
                'label' => 'Functiekenmerken',
                'name' => 'features',
                'type' => 'repeater',
                'instructions' => 'Voeg functiekenmerken toe (items met vinkje)',
                'required' => 0,
                'min' => 0,
                'max' => 20,
                'layout' => 'block',
                'button_label' => 'Kenmerk toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_csif_feature_text',
                        'label' => 'Kenmerktekst',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'De tekst voor dit kenmerk',
                        'required' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_csif_right_column_tab',
                'label' => 'Rechter Kolom',
                'name' => 'right_column_tab',
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
                'key' => 'field_csif_right_sections',
                'label' => 'Rechter Kolom Secties',
                'name' => 'right_sections',
                'type' => 'repeater',
                'instructions' => 'Voeg secties toe voor de rechter kolom',
                'required' => 0,
                'min' => 0,
                'max' => 5,
                'layout' => 'block',
                'button_label' => 'Sectie toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_csif_section_title',
                        'label' => 'Sectie Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'De titel voor deze sectie',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_csif_section_content',
                        'label' => 'Sectie Inhoud',
                        'name' => 'content',
                        'type' => 'textarea',
                        'instructions' => 'De inhoud voor deze sectie',
                        'required' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_csif_accordion_endpoint',
                'label' => 'Content Section with Image and Features Endpoint',
                'name' => 'accordion_csif_endpoint',
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
                    'value' => 'acf/content-section-with-image-and-features',
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