<?php
/**
 * Block Name: Afbeelding met Content
 * Description: Een sectie met afbeelding en content naast elkaar.
 * Category: custom-blocks
 * Icon: align-pull-left
 * Keywords: image, content, cta, features
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_image_with_content_block');
}

function register_image_with_content_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'cta-with-tabs',
            'title'             => __('Afbeelding met Content', 'developing-theme'),
            'description'       => __('Een sectie met afbeelding en content naast elkaar.', 'developing-theme'),
            'render_template'   => 'resources/blocks/cta-with-tabs/cta-with-tabs.php',
            'category'          => 'custom-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array('image', 'content', 'cta', 'features'),
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
    add_action('acf/init', 'register_image_with_content_fields');
}

function register_image_with_content_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_image_with_content',
        'title' => 'Afbeelding met Content Instellingen',
        'fields' => array(
            array(
                'key' => 'field_iwc_accordion',
                'label' => 'Afbeelding met Content Instellingen',
                'name' => 'accordion_iwc',
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
                'key' => 'field_iwc_general_tab',
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
                'key' => 'field_iwc_section_background',
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
                'key' => 'field_iwc_content_tab',
                'label' => 'Content Secties',
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
                'key' => 'field_iwc_content_sections',
                'label' => 'Content Secties',
                'name' => 'content_sections',
                'type' => 'repeater',
                'instructions' => 'Voeg content secties toe. Elke sectie bestaat uit een afbeelding en content.',
                'required' => 0,
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Content sectie toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_iwc_section_image_position',
                        'label' => 'Afbeeldingspositie',
                        'name' => 'image_position',
                        'type' => 'select',
                        'instructions' => 'Kies de positie van de afbeelding',
                        'required' => 0,
                        'choices' => array(
                            'left' => 'Links',
                            'right' => 'Rechts',
                        ),
                        'default_value' => 'left',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_iwc_section_image',
                        'label' => 'Afbeelding',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'De afbeelding voor deze sectie',
                        'required' => 0,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_iwc_section_heading',
                        'label' => 'Hoofdtitel',
                        'name' => 'heading',
                        'type' => 'text',
                        'instructions' => 'De hoofdtitel voor deze sectie',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_iwc_section_description',
                        'label' => 'Beschrijving',
                        'name' => 'description',
                        'type' => 'wysiwyg',
                        'instructions' => 'De beschrijvende tekst voor deze sectie',
                        'required' => 0,
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                    ),
                    array(
                        'key' => 'field_iwc_section_features',
                        'label' => 'Features',
                        'name' => 'features',
                        'type' => 'repeater',
                        'instructions' => 'Voeg features toe voor deze sectie',
                        'required' => 0,
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'block',
                        'button_label' => 'Feature toevoegen',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_iwc_section_feature_text',
                                'label' => 'Feature Tekst',
                                'name' => 'text',
                                'type' => 'text',
                                'instructions' => 'De tekst voor deze feature',
                                'required' => 1,
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_iwc_section_primary_button',
                        'label' => 'Primaire Knop',
                        'name' => 'primary_button',
                        'type' => 'group',
                        'instructions' => 'Instellingen voor de primaire knop',
                        'required' => 0,
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_iwc_section_primary_button_text',
                                'label' => 'Tekst',
                                'name' => 'text',
                                'type' => 'text',
                                'instructions' => 'De tekst voor de primaire knop',
                                'required' => 0,
                            ),
                            array(
                                'key' => 'field_iwc_section_primary_button_url',
                                'label' => 'URL',
                                'name' => 'url',
                                'type' => 'url',
                                'instructions' => 'De URL voor de primaire knop',
                                'required' => 0,
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_iwc_section_secondary_button',
                        'label' => 'Secundaire Knop',
                        'name' => 'secondary_button',
                        'type' => 'group',
                        'instructions' => 'Instellingen voor de secundaire knop',
                        'required' => 0,
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_iwc_section_secondary_button_text',
                                'label' => 'Tekst',
                                'name' => 'text',
                                'type' => 'text',
                                'instructions' => 'De tekst voor de secundaire knop',
                                'required' => 0,
                            ),
                            array(
                                'key' => 'field_iwc_section_secondary_button_url',
                                'label' => 'URL',
                                'name' => 'url',
                                'type' => 'url',
                                'instructions' => 'De URL voor de secundaire knop',
                                'required' => 0,
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_iwc_accordion_endpoint',
                'label' => 'Afbeelding met Content Endpoint',
                'name' => 'accordion_iwc_endpoint',
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
                    'value' => 'acf/cta-with-tabs',
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