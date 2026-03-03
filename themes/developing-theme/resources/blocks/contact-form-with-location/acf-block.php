<?php
/**
 * Block Name: Contact Form with Location
 * Description: Een sectie met een contactformulier en locatiegegevens.
 * Category: custom-blocks
 * Icon: email
 * Keywords: contact, form, location, gravity, map
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_contact_form_with_location_block');
}

function register_contact_form_with_location_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'contact-form-with-location',
            'title'             => __('Contact Form with Location', 'developing-theme'),
            'description'       => __('Een sectie met een contactformulier en locatiegegevens.', 'developing-theme'),
            'render_template'   => 'resources/blocks/contact-form-with-location/contact-form-with-location.php',
            'category'          => 'custom-blocks',
            'icon'              => 'email',
            'keywords'          => array('contact', 'form', 'location', 'gravity', 'map'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'heading'      => 'Neem contact met ons op',
                        'is_preview'   => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_contact_form_with_location_fields');
}

function register_contact_form_with_location_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_contact_form_with_location',
        'title' => 'Contact Form with Location Instellingen',
        'fields' => array(
            array(
                'key' => 'field_cfwl_accordion',
                'label' => 'Contact Form with Location Instellingen',
                'name' => 'accordion_cfwl',
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
                'key' => 'field_cfwl_general_tab',
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
                'key' => 'field_cfwl_section_background',
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
                'key' => 'field_cfwl_heading',
                'label' => 'Hoofdtitel',
                'name' => 'heading',
                'type' => 'text',
                'instructions' => 'Voer de hoofdtitel voor het contactformulier in',
                'required' => 1,
                'default_value' => 'Neem contact met ons op',
            ),
            array(
                'key' => 'field_cfwl_form_tab',
                'label' => 'Formulier Instellingen',
                'name' => 'form_tab',
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
                'key' => 'field_cfwl_gravity_form',
                'label' => 'Gravity Form',
                'name' => 'gravity_form',
                'type' => 'text',
                'instructions' => 'Voer de Gravity Form ID of shortcode in. Bijvoorbeeld: [gravityform id="1" title="false" description="false"]',
                'required' => 1,
                'default_value' => '[gravityform id="1" title="false" description="false"]',
            ),
            array(
                'key' => 'field_cfwl_location_tab',
                'label' => 'Locatie Instellingen',
                'name' => 'location_tab',
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
                'key' => 'field_cfwl_show_location',
                'label' => 'Toon Locatie Informatie',
                'name' => 'show_location',
                'type' => 'true_false',
                'instructions' => 'Schakel dit in om de locatie-informatie te tonen',
                'required' => 0,
                'default_value' => 1,
                'ui' => 1,
            ),
            array(
                'key' => 'field_cfwl_location_title',
                'label' => 'Locatie Titel',
                'name' => 'location_title',
                'type' => 'text',
                'instructions' => 'Voer de titel voor het locatiegedeelte in',
                'required' => 0,
                'default_value' => 'Contactpunten',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_cfwl_show_location',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cfwl_locations',
                'label' => 'Locaties',
                'name' => 'locations',
                'type' => 'repeater',
                'instructions' => 'Voeg locaties toe',
                'required' => 0,
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Locatie toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cfwl_location_name',
                        'label' => 'Naam',
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => 'Voer de naam van de locatie in',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_cfwl_location_address',
                        'label' => 'Adres',
                        'name' => 'address',
                        'type' => 'textarea',
                        'instructions' => 'Voer het adres in',
                        'required' => 0,
                        'rows' => 3,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_cfwl_show_location',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cfwl_contact_info',
                'label' => 'Contactgegevens',
                'name' => 'contact_info',
                'type' => 'repeater',
                'instructions' => 'Voeg contactgegevens toe',
                'required' => 0,
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Contactgegeven toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cfwl_contact_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Voer de titel in (bijv. "Informatie & Verkoop")',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_cfwl_contact_email',
                        'label' => 'E-mailadres',
                        'name' => 'email',
                        'type' => 'email',
                        'instructions' => 'Voer het e-mailadres in',
                        'required' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_cfwl_contact_phone',
                        'label' => 'Telefoonnummer',
                        'name' => 'phone',
                        'type' => 'text',
                        'instructions' => 'Voer het telefoonnummer in',
                        'required' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_cfwl_show_location',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cfwl_accordion_endpoint',
                'label' => 'Contact Form with Location Endpoint',
                'name' => 'accordion_cfwl_endpoint',
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
                    'value' => 'acf/contact-form-with-location',
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