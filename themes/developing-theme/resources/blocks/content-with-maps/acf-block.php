<?php
/**
 * Block Name: Content with Maps
 * Description: Een sectie met een titel, beschrijving en een Google Maps kaart.
 * Category: custom-blocks
 * Icon: location-alt
 * Keywords: map, maps, location, content, google
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_content_with_maps_block');
}

function register_content_with_maps_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'content-with-maps',
            'title'             => __('Content with Maps', 'developing-theme'),
            'description'       => __('Een sectie met een titel, beschrijving en een Google Maps kaart.', 'developing-theme'),
            'render_template'   => 'resources/blocks/content-with-maps/content-with-maps.php',
            'category'          => 'custom-blocks',
            'icon'              => 'location-alt',
            'keywords'          => array('map', 'maps', 'location', 'content', 'google'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'heading'      => 'We didn\'t reinvent the wheel',
                        'is_preview'   => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_content_with_maps_fields');
}

function register_content_with_maps_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_content_with_maps',
        'title' => 'Content with Maps Instellingen',
        'fields' => array(
            array(
                'key' => 'field_cwm_accordion',
                'label' => 'Content with Maps Instellingen',
                'name' => 'accordion_cwm',
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
                'key' => 'field_cwm_general_tab',
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
                'key' => 'field_cwm_section_background',
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
                'key' => 'field_cwm_layout',
                'label' => 'Kaart Positie',
                'name' => 'map_layout',
                'type' => 'select',
                'instructions' => 'Kies waar de kaart geplaatst moet worden ten opzichte van de tekst',
                'required' => 0,
                'choices' => array(
                    'below' => 'Onder de tekst',
                    'above' => 'Boven de tekst',
                    'left' => 'Links naast de tekst',
                    'right' => 'Rechts naast de tekst',
                ),
                'default_value' => 'below',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_cwm_heading',
                'label' => 'Titel',
                'name' => 'heading',
                'type' => 'text',
                'instructions' => 'Voer de hoofdtitel in',
                'required' => 1,
                'default_value' => 'We didn\'t reinvent the wheel',
            ),
            array(
                'key' => 'field_cwm_description',
                'label' => 'Beschrijving',
                'name' => 'description',
                'type' => 'wysiwyg',
                'instructions' => 'Voer de beschrijving in',
                'required' => 1,
                'default_value' => 'We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_cwm_map_tab',
                'label' => 'Kaart Instellingen',
                'name' => 'map_tab',
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
                'key' => 'field_cwm_map_type',
                'label' => 'Kaart Type',
                'name' => 'map_type',
                'type' => 'select',
                'instructions' => 'Kies het type kaart',
                'required' => 0,
                'choices' => array(
                    'place' => 'Locatie (naam of adres)',
                    'view' => 'Aangepaste weergave (coördinaten en zoom niveau)',
                ),
                'default_value' => 'place',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_cwm_map_location',
                'label' => 'Locatie',
                'name' => 'map_location',
                'type' => 'text',
                'instructions' => 'Voer een locatie in (naam van stad, land of volledig adres)',
                'required' => 1,
                'default_value' => 'Amsterdam,Netherlands',
            ),
            array(
                'key' => 'field_cwm_map_zoom',
                'label' => 'Zoom Niveau',
                'name' => 'map_zoom',
                'type' => 'range',
                'instructions' => 'Selecteer het zoom niveau (alleen van toepassing bij "Aangepaste weergave")',
                'required' => 0,
                'default_value' => 14,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_cwm_map_type',
                            'operator' => '==',
                            'value' => 'view',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cwm_map_height',
                'label' => 'Kaart Hoogte',
                'name' => 'map_height',
                'type' => 'number',
                'instructions' => 'Geef de hoogte op voor de Google Maps kaart in pixels.',
                'required' => 0,
                'default_value' => 400,
                'min' => 200,
                'max' => 800,
                'step' => 10,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'px',
            ),
            array(
                'key' => 'field_cwm_accordion_endpoint',
                'label' => 'Content with Maps Endpoint',
                'name' => 'accordion_cwm_endpoint',
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
                    'value' => 'acf/content-with-maps',
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