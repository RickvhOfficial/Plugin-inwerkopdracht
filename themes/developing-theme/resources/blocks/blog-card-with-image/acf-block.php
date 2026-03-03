<?php
/**
 * Block Name: Blog Card with Image
 * Description: Toon blogberichten met featured image, categorie, titel en samenvatting
 * Category: custom-blocks
 * Icon: grid-view
 * Keywords: blog, card, image, post, grid
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_blog_card_with_image_block');
}

function register_blog_card_with_image_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'blog-card-with-image',
            'title'             => __('Blog Card with Image', 'developing-theme'),
            'description'       => __('Toon blogberichten met featured image, categorie, titel en samenvatting', 'developing-theme'),
            'render_template'   => 'resources/blocks/blog-card-with-image/blog-card-with-image.php',
            'category'          => 'custom-blocks',
            'icon'              => 'grid-view',
            'keywords'          => array('blog', 'card', 'image', 'post', 'grid'),
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
    add_action('acf/init', 'register_blog_card_with_image_fields');
}

function register_blog_card_with_image_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_blog_card_with_image',
        'title' => 'Blog Card with Image Instellingen',
        'fields' => array(
            array(
                'key' => 'field_bcwi_accordion',
                'label' => 'Blog Card with Image Instellingen',
                'name' => 'accordion_bcwi',
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
                'key' => 'field_bcwi_general_tab',
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
                'key' => 'field_bcwi_section_title',
                'label' => 'Sectie Titel',
                'name' => 'section_title',
                'type' => 'text',
                'instructions' => 'De titel voor deze blog sectie (optioneel)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Laatste Berichten',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_bcwi_section_background',
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
                'key' => 'field_bcwi_posts_tab',
                'label' => 'Post Instellingen',
                'name' => 'posts_tab',
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
                'key' => 'field_bcwi_posts_per_row',
                'label' => 'Posts per Rij',
                'name' => 'posts_per_row',
                'type' => 'select',
                'instructions' => 'Kies hoeveel posts naast elkaar getoond worden',
                'required' => 0,
                'choices' => array(
                    '1' => '1 post per rij (full width)',
                    '2' => '2 posts per rij',
                    '3' => '3 posts per rij',
                    '4' => '4 posts per rij',
                ),
                'default_value' => '3',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_bcwi_posts_per_page',
                'label' => 'Posts per Pagina',
                'name' => 'posts_per_page',
                'type' => 'number',
                'instructions' => 'Hoeveel posts getoond worden per pagina',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 6,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'posts',
                'min' => 1,
                'max' => 24,
                'step' => 1,
            ),
            array(
                'key' => 'field_bcwi_show_pagination',
                'label' => 'Toon Paginering',
                'name' => 'show_pagination',
                'type' => 'true_false',
                'instructions' => 'Schakel paginering aan/uit',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Aan',
                'ui_off_text' => 'Uit',
            ),
            array(
                'key' => 'field_bcwi_category_filter',
                'label' => 'Filter op Categorie',
                'name' => 'category_filter',
                'type' => 'taxonomy',
                'instructions' => 'Beperk posts tot deze categorie (optioneel)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'taxonomy' => 'category',
                'field_type' => 'select',
                'allow_null' => 1,
                'add_term' => 0,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'id',
                'multiple' => 0,
            ),
            array(
                'key' => 'field_bcwi_display_tab',
                'label' => 'Weergave Opties',
                'name' => 'display_tab',
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
                'key' => 'field_bcwi_show_category',
                'label' => 'Toon Categorie',
                'name' => 'show_category',
                'type' => 'true_false',
                'instructions' => 'Toon de categorie label van de post',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Aan',
                'ui_off_text' => 'Uit',
            ),
            array(
                'key' => 'field_bcwi_show_excerpt',
                'label' => 'Toon Samenvatting',
                'name' => 'show_excerpt',
                'type' => 'true_false',
                'instructions' => 'Toon de samenvatting van de post',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Aan',
                'ui_off_text' => 'Uit',
            ),
            array(
                'key' => 'field_bcwi_excerpt_length',
                'label' => 'Lengte Samenvatting',
                'name' => 'excerpt_length',
                'type' => 'number',
                'instructions' => 'Aantal woorden in de samenvatting',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_bcwi_show_excerpt',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 20,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'woorden',
                'min' => 5,
                'max' => 100,
                'step' => 1,
            ),
            array(
                'key' => 'field_bcwi_show_read_more',
                'label' => 'Toon "Lees Meer" Link',
                'name' => 'show_read_more',
                'type' => 'true_false',
                'instructions' => 'Toon een "lees meer" link voor elke post',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Aan',
                'ui_off_text' => 'Uit',
            ),
            array(
                'key' => 'field_bcwi_read_more_text',
                'label' => '"Lees Meer" Tekst',
                'name' => 'read_more_text',
                'type' => 'text',
                'instructions' => 'De tekst voor de "lees meer" link',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_bcwi_show_read_more',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Lees meer',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_bcwi_accordion_endpoint',
                'label' => 'Blog Card with Image Endpoint',
                'name' => 'accordion_bcwi_endpoint',
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
                    'value' => 'acf/blog-card-with-image',
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