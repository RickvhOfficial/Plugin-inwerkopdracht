<?php
/**
 * Block Name: Default Blog Card
 * Description: Een blok dat de nieuwste 2 blogberichten weergeeft
 * Category: custom-blocks
 * Icon: admin-post
 * Keywords: blog, card, posts, recent
 * Supports: { "align": false, "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_default_blog_card_block');
}

function register_default_blog_card_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'default-blog-card',
            'title'             => __('Default Blog Card', 'developing-theme'),
            'description'       => __('Een blok dat de nieuwste 2 blogberichten weergeeft', 'developing-theme'),
            'render_template'   => get_template_directory() . '/resources/blocks/default-blog-card/default-blog-card.php',
            'category'          => 'custom-blocks',
            'icon'              => 'admin-post',
            'keywords'          => array('blog', 'card', 'posts', 'recent'),
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
        register_default_blog_card_fields();
    }
}

function register_default_blog_card_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_default_blog_card',
        'title' => 'Default Blog Card Instellingen',
        'fields' => array(
            array(
                'key' => 'field_blog_accordion_content',
                'label' => 'Blog sectie',
                'name' => 'accordion_content_blog',
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
                'label' => 'Koptekst',
                'name' => 'header_title',
                'type' => 'text',
                'instructions' => 'De hoofdtitel boven de blogkaarten',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Recente blogberichten',
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
                'instructions' => 'Een korte beschrijving onder de koptekst',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Bekijk hier onze meest recente blogartikelen',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 3,
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_blog_accordion_content_endpoint',
                'label' => 'Content Einde',
                'name' => 'accordion_content_blog_endpoint',
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
                    'value' => 'acf/default-blog-card',
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