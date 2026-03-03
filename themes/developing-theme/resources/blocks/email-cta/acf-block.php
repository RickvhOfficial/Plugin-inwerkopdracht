<?php
/**
 * Block Name: Email CTA
 * Description: Een blok met een call-to-action voor email aanmelding via Gravity Forms
 * Category: custom-blocks
 * Icon: email-alt
 * Keywords: email, cta, form, gravity forms
 * Supports: { "align": false, "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_email_cta_block');
}

function register_email_cta_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'email-cta',
            'title'             => __('Email CTA', 'developing-theme'),
            'description'       => __('Een blok met een call-to-action voor email aanmelding via Gravity Forms', 'developing-theme'),
            'render_template'   => get_template_directory() . '/resources/blocks/email-cta/email-cta.php',
            'category'          => 'custom-blocks',
            'icon'              => 'email-alt',
            'keywords'          => array('email', 'cta', 'form', 'gravity forms'),
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
        register_email_cta_fields();
    }
}

function register_email_cta_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_email_cta',
        'title' => 'Email CTA Instellingen',
        'fields' => array(
            array(
                'key' => 'field_email_accordion_content',
                'label' => 'Email CTA Instellingen',
                'name' => 'accordion_content_email',
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
                'key' => 'field_email_title',
                'label' => 'Titel',
                'name' => 'email_title',
                'type' => 'text',
                'instructions' => 'De titel van het email CTA blok',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Schrijf je in voor onze nieuwsbrief',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_email_description',
                'label' => 'Beschrijving',
                'name' => 'email_description',
                'type' => 'textarea',
                'instructions' => 'Een korte beschrijving of uitleg over de aanmelding',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Blijf op de hoogte van het laatste nieuws en ontvang updates direct in je inbox.',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 3,
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_gravity_form_shortcode',
                'label' => 'Gravity Form Shortcode',
                'name' => 'gravity_form_shortcode',
                'type' => 'text',
                'instructions' => 'Voer de Gravity Forms shortcode in (bijv. [gravityform id="1" title="false" description="false"])',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '[gravityform id="1" title="false" description="false"]',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_disclaimer_text',
                'label' => 'Disclaimer Tekst',
                'name' => 'disclaimer_text',
                'type' => 'text',
                'instructions' => 'Optionele tekst onder het formulier (bijv. privacybeleid verwijzing)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Door je aan te melden ga je akkoord met onze privacyverklaring.',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_email_accordion_content_endpoint',
                'label' => 'Email CTA Endpoint',
                'name' => 'accordion_content_email_endpoint',
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
                    'value' => 'acf/email-cta',
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