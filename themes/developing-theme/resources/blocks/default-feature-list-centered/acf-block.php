<?php
/**
 * Block Name: Default Feature List Centered
 * Description: Een blok dat een gecentreerde lijst met features weergeeft
 * Category: custom-blocks
 * Icon: align-center
 * Keywords: feature, list, centered
 * Supports: { "align": false, "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_default_feature_list_centered_block');
}

function register_default_feature_list_centered_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'default-feature-list-centered',
            'title'             => __('Default Feature List Centered', 'developing-theme'),
            'description'       => __('Een blok dat een gecentreerde lijst met features weergeeft', 'developing-theme'),
            'render_template'   => 'resources/blocks/default-feature-list-centered/default-feature-list-centered.php',
            'category'          => 'custom-blocks',
            'icon'              => 'align-center',
            'keywords'          => array('feature', 'list', 'centered'),
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'customClassName' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'header_title'      => 'Designed for business teams like yours',
                        'header_description' => 'Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.',
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_default_feature_list_centered_fields');
}

function register_default_feature_list_centered_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_default_feature_list_centered',
        'title' => 'Default Feature List Centered Block',
        'fields' => array(
            array(
                'key' => 'field_dfc_accordion_content',
                'label' => 'Feature List Centered Instellingen',
                'name' => 'accordion_content_dfc',
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
                'key' => 'field_header_title',
                'label' => 'Titel',
                'name' => 'header_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Designed for business teams like yours',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_header_description',
                'label' => 'Beschrijving',
                'name' => 'header_description',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 3,
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_features',
                'label' => 'Features',
                'name' => 'features',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Feature toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_feature_icon',
                        'label' => 'Icoon',
                        'name' => 'icon',
                        'type' => 'image',
                        'instructions' => 'Upload een icoon afbeelding',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
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
                        'key' => 'field_feature_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => 'Bijvoorbeeld: Marketing',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_feature_description',
                        'label' => 'Beschrijving',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => '',
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
                        'rows' => 3,
                        'new_lines' => 'br',
                    ),
                ),
            ),
            array(
                'key' => 'field_dfc_accordion_content_endpoint',
                'label' => 'Feature List Centered Endpoint',
                'name' => 'accordion_content_dfc_endpoint',
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
                    'value' => 'acf/default-feature-list-centered',
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