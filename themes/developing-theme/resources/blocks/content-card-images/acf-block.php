<?php
/**
 * Block Name: Content Card Images
 * Description: Een block dat een sectie met aanbod posts weergeeft als kaarten met afbeeldingen en tekst.
 * Category: custom-blocks
 * Icon: images-alt2
 * Keywords: content, card, images, columns, aanbod
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_content_card_images_block');
}

function register_content_card_images_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'content-card-images',
            'title'             => __('Content Card Images', 'developing-theme'),
            'description'       => __('Een block dat een sectie met aanbod posts weergeeft als kaarten met afbeeldingen en tekst.', 'developing-theme'),
            'render_template'   => 'resources/blocks/content-card-images/content-card-images.php',
            'category'          => 'custom-blocks',
            'icon'              => 'images-alt2',
            'keywords'          => array('content', 'card', 'images', 'columns', 'aanbod'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'heading'           => 'Ons aanbod',
                        'link_text'         => 'Bekijk al ons aanbod',
                        'link_url'          => '#',
                        'posts_per_page'    => 3,
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_content_card_images_fields');
}

function register_content_card_images_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_content_card_images',
        'title' => 'Content Card Images Block',
        'fields' => array(
            array(
                'key' => 'field_cci_accordion_content',
                'label' => 'Content Card Images Instellingen',
                'name' => 'accordion_content_cci',
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
                'key' => 'field_heading',
                'label' => 'Hoofdtitel',
                'name' => 'heading',
                'type' => 'text',
                'instructions' => 'Voer de hoofdtitel in',
                'required' => 1,
                'default_value' => 'Ons aanbod',
            ),
            array(
                'key' => 'field_link_text',
                'label' => 'Link Tekst',
                'name' => 'link_text',
                'type' => 'text',
                'instructions' => 'Tekst voor de link (optioneel)',
                'required' => 0,
                'default_value' => 'Bekijk al ons aanbod',
            ),
            array(
                'key' => 'field_link_url',
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'url',
                'instructions' => 'URL voor de link (optioneel)',
                'required' => 0,
                'default_value' => '/aanbod',
            ),
            array(
                'key' => 'field_posts_per_page',
                'label' => 'Aantal posts',
                'name' => 'posts_per_page',
                'type' => 'number',
                'instructions' => 'Aantal posts om weer te geven',
                'required' => 1,
                'default_value' => 3,
                'min' => 1,
                'max' => 12,
                'step' => 1,
            ),
            array(
                'key' => 'field_grid_columns',
                'label' => 'Aantal kolommen',
                'name' => 'grid_columns',
                'type' => 'select',
                'instructions' => 'Selecteer het aantal kolommen voor de grid',
                'required' => 0,
                'choices' => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                ),
                'default_value' => 3,
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_show_pagination',
                'label' => 'Toon paginanummers',
                'name' => 'show_pagination',
                'type' => 'true_false',
                'instructions' => 'Schakel aan om paginanummers weer te geven',
                'required' => 0,
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Aan',
                'ui_off_text' => 'Uit',
            ),
            array(
                'key' => 'field_cci_accordion_content_endpoint',
                'label' => 'Content Card Images Endpoint',
                'name' => 'accordion_content_cci_endpoint',
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
                    'value' => 'acf/content-card-images',
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