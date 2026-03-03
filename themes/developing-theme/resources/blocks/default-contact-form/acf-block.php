<?php
/**
 * Block Name: Default Contact Form
 * Description: Een sectie met een titel, beschrijving en een contactformulier via Gravity Forms.
 * Category: custom-blocks
 * Icon: email-alt
 * Keywords: contact, form, gravity form, mail, email
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_default_contact_form_block');
}

function register_default_contact_form_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'default-contact-form',
            'title'             => __('Default Contact Form', 'developing-theme'),
            'description'       => __('Een sectie met een titel, beschrijving en een contactformulier via Gravity Forms.', 'developing-theme'),
            'render_template'   => 'resources/blocks/default-contact-form/default-contact-form.php',
            'category'          => 'custom-blocks',
            'icon'              => 'email-alt',
            'keywords'          => array('contact', 'form', 'gravity form', 'mail', 'email'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'heading'      => 'Contact Us',
                        'is_preview'   => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_default_contact_form_fields');
}

function register_default_contact_form_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_default_contact_form',
        'title' => 'Default Contact Form Instellingen',
        'fields' => array(
            array(
                'key' => 'field_dcf_accordion',
                'label' => 'Default Contact Form Instellingen',
                'name' => 'accordion_dcf',
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
                'key' => 'field_dcf_general_tab',
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
                'key' => 'field_dcf_section_background',
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
                'key' => 'field_dcf_heading',
                'label' => 'Titel',
                'name' => 'heading',
                'type' => 'text',
                'instructions' => 'Voer de hoofdtitel in',
                'required' => 1,
                'default_value' => 'Contact Us',
            ),
            array(
                'key' => 'field_dcf_description',
                'label' => 'Beschrijving',
                'name' => 'description',
                'type' => 'wysiwyg',
                'instructions' => 'Voer een beschrijving in',
                'required' => 0,
                'default_value' => 'Got a technical issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_dcf_form_tab',
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
                'key' => 'field_dcf_form_shortcode',
                'label' => 'Formulier Shortcode',
                'name' => 'form_shortcode',
                'type' => 'text',
                'instructions' => 'Voer de Gravity Forms shortcode in, bijvoorbeeld: [gravityform id="1" title="false" description="false" ajax="true"]',
                'required' => 0,
                'default_value' => '',
                'placeholder' => '[gravityform id="1" title="false" description="false" ajax="true"]',
            ),
            array(
                'key' => 'field_dcf_accordion_endpoint',
                'label' => 'Default Contact Form Endpoint',
                'name' => 'accordion_dcf_endpoint',
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
                    'value' => 'acf/default-contact-form',
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