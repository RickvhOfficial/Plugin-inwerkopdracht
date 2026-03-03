<?php
/**
 * Block Name: Content Section with CTA
 * Description: Twee kolommen met informatie en een optionele CTA-knop.
 * Category: custom-blocks
 * Icon: columns
 * Keywords: content, section, cta, columns, two-column
 * Supports: { "align":["wide","full"], "anchor": true }
 */

// ACF Block registreren
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_content_section_with_cta_block');
}

function register_content_section_with_cta_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'content-section-with-cta',
            'title'             => __('Content Section with CTA', 'developing-theme'),
            'description'       => __('Twee kolommen met informatie en een optionele CTA-knop.', 'developing-theme'),
            'render_template'   => 'resources/blocks/content-section-with-cta/content-section-with-cta.php',
            'category'          => 'custom-blocks',
            'icon'              => 'columns',
            'keywords'          => array('content', 'section', 'cta', 'columns', 'two-column'),
            'supports'          => array(
                'align' => array('wide', 'full'),
                'anchor' => true,
            ),
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'left_section_title'   => 'Overview',
                        'is_preview'          => true
                    ),
                ),
            ),
        ));
    }
}

// ACF Velden registreren
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', 'register_content_section_with_cta_fields');
}

function register_content_section_with_cta_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_content_section_with_cta',
        'title' => 'Content Section with CTA Instellingen',
        'fields' => array(
            array(
                'key' => 'field_cswc_content_accordion',
                'label' => 'Content Section with CTA Instellingen',
                'name' => 'content_section_with_cta_accordion',
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
                'key' => 'field_cswc_general_tab',
                'label' => 'Algemeen',
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
                'key' => 'field_cswc_section_background',
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
                'key' => 'field_cswc_left_column_tab',
                'label' => 'Linker Kolom',
                'name' => 'left_column_tab',
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
                'key' => 'field_cswc_left_section_title',
                'label' => 'Titel',
                'name' => 'left_section_title',
                'type' => 'text',
                'instructions' => 'Voer de titel in voor de linker kolom',
                'required' => 1,
                'default_value' => 'Overview',
            ),
            array(
                'key' => 'field_cswc_left_section_content',
                'label' => 'Inhoud',
                'name' => 'left_section_content',
                'type' => 'wysiwyg',
                'instructions' => 'Voer de inhoud in voor de linker kolom',
                'required' => 1,
                'default_value' => 'Since 1984, Flowbite has been serving up grab-and-go frozen daiquiris from its stores across the U.S. Its signature drinks, souvenir cups, and discounted refills have made Flowbite synonymous with great music, good vibes, and starting the best party in town.',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_cswc_features',
                'label' => 'Features',
                'name' => 'features',
                'type' => 'repeater',
                'instructions' => 'Voeg features toe (worden getoond met checkmarks)',
                'required' => 0,
                'min' => 0,
                'max' => 12,
                'layout' => 'block',
                'button_label' => 'Feature toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cswc_feature_text',
                        'label' => 'Feature tekst',
                        'name' => 'feature_text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cswc_right_column_tab',
                'label' => 'Rechter Kolom',
                'name' => 'right_column_tab',
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
                'key' => 'field_cswc_right_sections',
                'label' => 'Secties',
                'name' => 'right_sections',
                'type' => 'repeater',
                'instructions' => 'Voeg secties toe aan de rechter kolom',
                'required' => 0,
                'min' => 0,
                'max' => 4,
                'layout' => 'block',
                'button_label' => 'Sectie toevoegen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cswc_section_title',
                        'label' => 'Sectie titel',
                        'name' => 'section_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_cswc_section_content',
                        'label' => 'Sectie inhoud',
                        'name' => 'section_content',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 1,
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cswc_cta_tab',
                'label' => 'CTA Instellingen',
                'name' => 'cta_tab',
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
                'key' => 'field_cswc_cta_enabled',
                'label' => 'CTA Knop Inschakelen',
                'name' => 'cta_enabled',
                'type' => 'true_false',
                'instructions' => 'Schakel de CTA knop in',
                'required' => 0,
                'default_value' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_cswc_cta_text',
                'label' => 'CTA Tekst',
                'name' => 'cta_text',
                'type' => 'text',
                'instructions' => 'Voer de tekst in voor de CTA knop',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_cswc_cta_enabled',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cswc_cta_link',
                'label' => 'CTA Link',
                'name' => 'cta_link',
                'type' => 'link',
                'instructions' => 'Voer de link in voor de CTA knop',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_cswc_cta_enabled',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_cswc_cta_style',
                'label' => 'CTA Stijl',
                'name' => 'cta_style',
                'type' => 'select',
                'instructions' => 'Kies de stijl voor de CTA knop',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_cswc_cta_enabled',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
                'choices' => array(
                    'primary' => 'Primair',
                    'secondary' => 'Secundair',
                    'outline' => 'Outline',
                ),
                'default_value' => 'primary',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_cswc_content_accordion_endpoint',
                'label' => 'Content Section with CTA Endpoint',
                'name' => 'content_section_with_cta_accordion_endpoint',
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
                    'value' => 'acf/content-section-with-cta',
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