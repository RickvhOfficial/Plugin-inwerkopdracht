<?php
/**
 * Block Name: Image with Feature List
 * Description: Een blok met een afbeelding links en een lijst van features rechts
 * Category: custom-blocks
 * Icon: list-view
 * Keywords: image, features, list, info, details
 * Supports: { "align": false, "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_image_with_feature_list_block');
}

function register_image_with_feature_list_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'image-with-feature-list',
            'title'             => __('Image with Feature List', 'developing-theme'),
            'description'       => __('Een blok met een afbeelding links en een lijst van features rechts', 'developing-theme'),
            'render_template'   => get_template_directory() . '/resources/blocks/image-with-feature-list/image-with-feature-list.php',
            'category'          => 'custom-blocks',
            'icon'              => 'list-view',
            'keywords'          => array('image', 'features', 'list', 'info', 'details'),
            'supports'          => array(
                'anchor' => true,
                'align' => false,
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
        register_image_with_feature_list_fields();
    }
}

function register_image_with_feature_list_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_image_with_feature_list',
        'title' => 'Image with Feature List Instellingen',
        'fields' => array(
            array(
                'key' => 'field_iwfl_accordion_content',
                'label' => 'Afbeelding met features',
                'name' => 'accordion_content_iwfl',
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
                'key' => 'field_iwfl_image',
                'label' => 'Afbeelding',
                'name' => 'iwfl_image',
                'type' => 'image',
                'instructions' => 'De afbeelding die links wordt weergegeven',
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
                'key' => 'field_iwfl_image_height',
                'label' => 'Afbeeldingshoogte (px)',
                'name' => 'iwfl_image_height',
                'type' => 'number',
                'instructions' => 'Stel de hoogte van de afbeelding in pixels in (optioneel, laat leeg voor automatische hoogte)',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_iwfl_image',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => 'px',
                'min' => 100,
                'max' => 1000,
                'step' => 10,
            ),
            array(
                'key' => 'field_iwfl_title',
                'label' => 'Titel',
                'name' => 'iwfl_title',
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
                'key' => 'field_iwfl_description',
                'label' => 'Beschrijving',
                'name' => 'iwfl_description',
                'type' => 'textarea',
                'instructions' => 'Een korte beschrijving onder de titel en boven de features',
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
                'rows' => 4,
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_iwfl_bottom_text',
                'label' => 'Tekst onderaan',
                'name' => 'iwfl_bottom_text',
                'type' => 'textarea',
                'instructions' => 'Een korte tekst die onder de features wordt weergegeven',
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
            array(
                'key' => 'field_iwfl_features',
                'label' => 'Features',
                'name' => 'iwfl_features',
                'type' => 'repeater',
                'instructions' => 'Voeg features toe aan de lijst',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => 'field_iwfl_feature_title',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Voeg feature toe',
                'sub_fields' => array(
                    array(
                        'key' => 'field_iwfl_feature_icon_color',
                        'label' => 'Icoon achtergrond kleur',
                        'name' => 'icon_color',
                        'type' => 'select',
                        'instructions' => 'Kies de achtergrondkleur van het icoon',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '30',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'primary' => 'Primair (blauw)',
                            'purple' => 'Paars',
                            'teal' => 'Teal',
                            'green' => 'Groen',
                            'red' => 'Rood',
                            'orange' => 'Oranje',
                        ),
                        'default_value' => 'primary',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 1,
                        'ajax' => 0,
                        'return_format' => 'value',
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_iwfl_feature_icon_image',
                        'label' => 'Icoon afbeelding',
                        'name' => 'icon_image',
                        'type' => 'image',
                        'instructions' => 'Upload een afbeelding om te gebruiken als icoon',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '70',
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
                        'mime_types' => 'jpg, jpeg, png, gif, svg',
                    ),
                    array(
                        'key' => 'field_iwfl_feature_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'De titel van de feature',
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
                        'key' => 'field_iwfl_feature_description',
                        'label' => 'Beschrijving',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => 'De beschrijving van de feature',
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
                    array(
                        'key' => 'field_iwfl_feature_link',
                        'label' => 'Link tekst',
                        'name' => 'link_text',
                        'type' => 'text',
                        'instructions' => 'De tekst van de "learn more" link (optioneel)',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Learn more',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_iwfl_feature_url',
                        'label' => 'Link URL',
                        'name' => 'link_url',
                        'type' => 'url',
                        'instructions' => 'De URL van de link (laat leeg om geen link te tonen)',
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
                'key' => 'field_iwfl_accordion_content_endpoint',
                'label' => 'Content Einde',
                'name' => 'accordion_content_iwfl_endpoint',
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
                    'value' => 'acf/image-with-feature-list',
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