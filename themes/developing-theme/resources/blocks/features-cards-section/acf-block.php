<?php
/**
 * Feature Cards Section Block Registration
 */

add_action('acf/init', 'register_features_cards_section_block');

function register_features_cards_section_block() {
    // Controleer of de ACF functie bestaat
    if (function_exists('acf_register_block_type')) {
        // Registreer het block
        acf_register_block_type(array(
            'name'              => 'features-cards-section',
            'title'             => __('Features Cards Section', 'developing'),
            'description'       => __('Een sectie met feature cards die voordelen of services tonen.', 'developing'),
            'render_template'   => 'resources/blocks/features-cards-section/features-cards-section.php',
            'category'          => 'formatting',
            'icon'              => 'grid-view',
            'keywords'          => array('features', 'cards', 'services'),
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
        ));
    }

    // ACF Velden registreren
    if (function_exists('acf_add_local_field_group')) {
        register_features_cards_section_fields();
    }
}

function register_features_cards_section_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_features_cards_section',
        'title' => 'Features Cards Section Instellingen',
        'fields' => array(
            array(
                'key' => 'field_fcs_accordion_content',
                'label' => 'Features Cards Section Instellingen',
                'name' => 'accordion_content_fcs',
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
                'key' => 'field_fcs_title',
                'label' => 'Titel',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'De hoofdtitel van de sectie',
                'required' => 0,
                'default_value' => 'The most trusted cryptocurrency platform',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_fcs_description',
                'label' => 'Beschrijving',
                'name' => 'description',
                'type' => 'text',
                'instructions' => 'Een korte beschrijving onder de titel',
                'required' => 0,
                'default_value' => 'Here are a few reasons why you should choose Flowbite',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_fcs_features',
                'label' => 'Features',
                'name' => 'features',
                'type' => 'repeater',
                'instructions' => 'Voeg feature cards toe (aanbevolen: 3 of 6)',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Feature toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_fcs_feature_icon',
                        'label' => 'Icoon',
                        'name' => 'icon',
                        'type' => 'image',
                        'instructions' => 'Upload een icoon voor deze feature (aanbevolen: 100x100px)',
                        'required' => 0,
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'mime_types' => 'jpg, jpeg, png, svg',
                    ),
                    array(
                        'key' => 'field_fcs_feature_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Titel van de feature',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_fcs_feature_description',
                        'label' => 'Beschrijving',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => 'Beschrijving van de feature',
                        'required' => 0,
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_fcs_feature_link_url',
                        'label' => 'Link URL',
                        'name' => 'link_url',
                        'type' => 'url',
                        'instructions' => 'URL voor de "Lees meer" link (optioneel)',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_fcs_feature_link_text',
                        'label' => 'Link Tekst',
                        'name' => 'link_text',
                        'type' => 'text',
                        'instructions' => 'Tekst voor de "Lees meer" link',
                        'required' => 0,
                        'default_value' => 'Lees meer',
                    ),
                ),
            ),
            array(
                'key' => 'field_fcs_accordion_content_endpoint',
                'label' => 'Features Cards Section Endpoint',
                'name' => 'accordion_content_fcs_endpoint',
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
                    'value' => 'acf/features-cards-section',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));
} 