<?php
/**
 * Block Name: Overlay Cards with Zoom
 * Description: Een blok met kaarten met zoom-effect bij hover en tekstoverlay
 * Category: custom-blocks
 * Icon: grid-view
 * Keywords: cards, overlay, zoom, team, grid
 * Supports: { "align": false, "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_overlay_cards_with_zoom_block');
}

function register_overlay_cards_with_zoom_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'overlay-cards-with-zoom',
            'title'             => __('Overlay Cards with Zoom', 'developing-theme'),
            'description'       => __('Een blok met kaarten met zoom-effect bij hover en tekstoverlay', 'developing-theme'),
            'render_template'   => get_template_directory() . '/resources/blocks/overlay-cards-with-zoom/overlay-cards-with-zoom.php',
            'category'          => 'custom-blocks',
            'icon'              => 'grid-view',
            'keywords'          => array('cards', 'overlay', 'zoom', 'team', 'grid'),
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
        register_overlay_cards_with_zoom_fields();
    }
}

function register_overlay_cards_with_zoom_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_overlay_cards_with_zoom',
        'title' => 'Overlay Cards with Zoom Instellingen',
        'fields' => array(
            array(
                'key' => 'field_ocwz_accordion_content',
                'label' => 'Team cards',
                'name' => 'accordion_content_ocwz',
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
                'key' => 'field_ocwz_title',
                'label' => 'Titel',
                'name' => 'ocwz_title',
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
                'key' => 'field_ocwz_description',
                'label' => 'Beschrijving',
                'name' => 'ocwz_description',
                'type' => 'wysiwyg',
                'instructions' => 'Een beschrijving onder de titel',
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
                'key' => 'field_ocwz_secondary_description',
                'label' => 'Tweede beschrijving',
                'name' => 'ocwz_secondary_description',
                'type' => 'wysiwyg',
                'instructions' => 'Een tweede alinea onder de eerste beschrijving',
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
                'key' => 'field_ocwz_button',
                'label' => 'Knop',
                'name' => 'ocwz_button',
                'type' => 'group',
                'instructions' => 'Instellingen voor de knop (optioneel)',
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
                        'key' => 'field_ocwz_button_text',
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
                        'key' => 'field_ocwz_button_url',
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
                'key' => 'field_ocwz_cards',
                'label' => 'Kaarten',
                'name' => 'ocwz_cards',
                'type' => 'repeater',
                'instructions' => 'Voeg kaarten toe aan het grid',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => 'field_ocwz_card_name',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Voeg kaart toe',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ocwz_card_image',
                        'label' => 'Afbeelding',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload een afbeelding voor deze kaart',
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
                        'key' => 'field_ocwz_card_name',
                        'label' => 'Naam',
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => 'De naam die op de kaart wordt weergegeven',
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
                        'key' => 'field_ocwz_card_position',
                        'label' => 'Functie',
                        'name' => 'position',
                        'type' => 'text',
                        'instructions' => 'De functietitel die onder de naam wordt weergegeven',
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
                ),
            ),
            array(
                'key' => 'field_ocwz_accordion_content_endpoint',
                'label' => 'Content Einde',
                'name' => 'accordion_content_ocwz_endpoint',
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
                    'value' => 'acf/overlay-cards-with-zoom',
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