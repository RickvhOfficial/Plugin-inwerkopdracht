<?php
/**
 * Block Name: Grid Testimonial Cards
 * Description: Een blok dat een grid van testimonial cards weergeeft
 * Category: custom-blocks
 * Icon: testimonial
 * Keywords: testimonial, grid, cards, reviews
 * Supports: { "align": false, "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_grid_testimonial_cards_block');
}

function register_grid_testimonial_cards_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'grid-testimonial-cards',
            'title'             => __('Grid Testimonial Cards', 'developing-theme'),
            'description'       => __('Een blok dat een grid van testimonial cards weergeeft', 'developing-theme'),
            'render_template'   => 'resources/blocks/grid-testimonial-cards/grid-testimonial-cards.php',
            'category'          => 'custom-blocks',
            'icon'              => 'testimonial',
            'keywords'          => array('testimonial', 'grid', 'cards', 'reviews'),
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'customClassName' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'header_title'      => 'Testimonials',
                        'header_description' => 'Explore the whole collection of open-source web components and elements built with the utility classes from Tailwind',
                        'grid_columns'      => '3',
                        'testimonials'      => array(
                            array(
                                'title'    => 'Fantastische service',
                                'quote'    => 'Flowbite is just awesome. It contains tons of predesigned components and pages starting from login screen to complex dashboard. Perfect choice for your next SaaS application.',
                                'name'     => 'Michael Gough',
                                'position' => 'CEO at Google',
                                'image'    => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png'
                            ),
                            array(
                                'title'    => 'Uitzonderlijk product',
                                'quote'    => 'I recently purchased the template and I\'m very happy with it. The design is modern and clean, and it has all the features I need for my project.',
                                'name'     => 'Bonnie Green',
                                'position' => 'CTO at Facebook',
                                'image'    => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png'
                            ),
                            array(
                                'title'    => 'Geweldig team',
                                'quote'    => 'We have been using the template for our business and the results have been amazing. The support team is also very responsive and helpful.',
                                'name'     => 'Roberta Casas',
                                'position' => 'Lead Designer at Amazon',
                                'image'    => 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png'
                            ),
                        ),
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_grid_testimonial_cards_fields');
}

function register_grid_testimonial_cards_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_grid_testimonial_cards',
        'title' => 'Grid Testimonial Cards Block',
        'fields' => array(
            array(
                'key' => 'field_gtc_main_accordion',
                'label' => 'Grid Testimonial Cards Instellingen',
                'name' => 'grid_testimonial_cards_accordion',
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
                'key' => 'field_gtc_content_tab',
                'label' => 'Content',
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
                'default_value' => 'Testimonials',
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
                'default_value' => 'Explore the whole collection of open-source web components and elements built with the utility classes from Tailwind',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 3,
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_testimonials_tab',
                'label' => 'Testimonials',
                'name' => 'testimonials_tab',
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
                'key' => 'field_testimonials',
                'label' => 'Testimonials',
                'name' => 'testimonials',
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
                'button_label' => 'Testimonial toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_testimonial_title',
                        'label' => 'Testimonial Titel',
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
                        'placeholder' => 'Bijvoorbeeld: Solid foundation for any project',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_testimonial_quote',
                        'label' => 'Testimonial Tekst',
                        'name' => 'quote',
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
                    array(
                        'key' => 'field_testimonial_image',
                        'label' => 'Profielfoto',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload een profielfoto voor deze testimonial',
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
                        'key' => 'field_testimonial_name',
                        'label' => 'Naam',
                        'name' => 'name',
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
                        'placeholder' => 'Bijvoorbeeld: John Doe',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_testimonial_position',
                        'label' => 'Functie',
                        'name' => 'position',
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
                        'placeholder' => 'Bijvoorbeeld: CEO at Company',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_layout_tab',
                'label' => 'Layout',
                'name' => 'layout_tab',
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
                'key' => 'field_grid_columns',
                'label' => 'Aantal Kolommen',
                'name' => 'grid_columns',
                'type' => 'select',
                'instructions' => 'Kies het aantal kolommen in het grid',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    '1' => '1 Kolom',
                    '2' => '2 Kolommen',
                    '3' => '3 Kolommen',
                    '4' => '4 Kolommen',
                ),
                'default_value' => '3',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 1,
                'ajax' => 0,
                'return_format' => 'value',
                'placeholder' => '',
            ),
            array(
                'key' => 'field_gtc_main_accordion_endpoint',
                'label' => 'Grid Testimonial Cards Endpoint',
                'name' => 'grid_testimonial_cards_accordion_endpoint',
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
                    'value' => 'acf/grid-testimonial-cards',
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