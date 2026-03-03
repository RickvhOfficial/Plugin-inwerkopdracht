<?php
/**
 * Block Name: FAQ Accordion
 * Description: Een FAQ sectie met accordions voor veel gestelde vragen en antwoorden.
 * Category: custom-blocks
 * Icon: list-view
 * Keywords: faq, frequently asked questions, accordion, vragen, antwoorden
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_faq_accordion_block');
}

function register_faq_accordion_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'faq-accordion',
            'title'             => __('FAQ Accordion', 'developing-theme'),
            'description'       => __('Een FAQ sectie met accordions voor veel gestelde vragen en antwoorden.', 'developing-theme'),
            'render_template'   => 'resources/blocks/faq-accordion/faq-accordion.php',
            'category'          => 'custom-blocks',
            'icon'              => 'list-view',
            'keywords'          => array('faq', 'frequently asked questions', 'accordion', 'vragen', 'antwoorden'),
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
    add_action('acf/init', 'register_faq_accordion_fields');
}

function register_faq_accordion_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_faq_accordion',
        'title' => 'FAQ Accordion Instellingen',
        'fields' => array(
            array(
                'key' => 'field_faq_accordion',
                'label' => 'FAQ Accordion Instellingen',
                'name' => 'accordion_faq',
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
                'key' => 'field_faq_general_tab',
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
                'key' => 'field_faq_section_background',
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
                'key' => 'field_faq_heading',
                'label' => 'Hoofdtitel',
                'name' => 'heading',
                'type' => 'text',
                'instructions' => 'De hoofdtitel van de FAQ sectie',
                'required' => 0,
                'default_value' => 'Veel gestelde vragen',
            ),
            array(
                'key' => 'field_faq_introduction',
                'label' => 'Introductietekst',
                'name' => 'introduction',
                'type' => 'textarea',
                'instructions' => 'Een korte introductie voor de FAQ sectie (optioneel)',
                'required' => 0,
            ),
            array(
                'key' => 'field_faq_content_tab',
                'label' => 'FAQ Inhoud',
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
                'key' => 'field_faq_items',
                'label' => 'FAQ Items',
                'name' => 'faq_items',
                'type' => 'repeater',
                'instructions' => 'Voeg vragen en antwoorden toe',
                'required' => 0,
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'FAQ item toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_faq_question',
                        'label' => 'Vraag',
                        'name' => 'question',
                        'type' => 'text',
                        'instructions' => 'De vraag',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_faq_answer',
                        'label' => 'Antwoord',
                        'name' => 'answer',
                        'type' => 'wysiwyg',
                        'instructions' => 'Het antwoord',
                        'required' => 1,
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_faq_accordion_endpoint',
                'label' => 'FAQ Accordion Endpoint',
                'name' => 'accordion_faq_endpoint',
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
                    'value' => 'acf/faq-accordion',
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