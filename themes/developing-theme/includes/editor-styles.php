<?php
/**
 * Editor Styles
 * 
 * Zorgt voor de juiste styling van Gutenberg blocks in de editor
 * en voegt ondersteuning toe voor Tailwind CSS in de editor
 */

// Zorg ervoor dat de editor styling van Gutenberg blocks overeenkomt met frontend
function add_editor_styles_for_gutenberg() {
    // Voeg Tailwind CSS toe aan de editor
    add_theme_support('editor-styles');
    add_editor_style('assets/css/tailwind-output.css');
    
    // Zorg ervoor dat de blocks in de editor de volledige breedte gebruiken
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'add_editor_styles_for_gutenberg');

// Het mogelijk maken om Tailwind klassen te gebruiken in ACF velden in de editor
function do_not_strip_tags($value, $post_id, $field) {
    // Voorkom dat WordPress bepaalde HTML en class attributen verwijdert
    return $value;
}
add_filter('acf/format_value/type=wysiwyg', 'do_not_strip_tags', 10, 3);

// JavaScript om de preview mode uit blocks te verwijderen
function enqueue_block_editor_fixes() {
    wp_add_inline_script('wp-blocks', '
        wp.domReady(function() {
            // Fix voor ACF Block velden die grijs/readonly lijken
            setTimeout(function() {
                // Verwijder eventuele "preview" mode van blocks die al toegevoegd zijn
                jQuery(document).on("click", ".acf-block-fields input, .acf-block-fields textarea, .acf-block-fields select", function() {
                    jQuery(this).css({
                        "background-color": "#fff",
                        "color": "#000",
                        "opacity": "1",
                        "cursor": "text",
                        "pointer-events": "auto"
                    });
                });
                
                // Zorg ervoor dat ACF fields niet grijs/readonly zijn
                var style = document.createElement("style");
                style.textContent = `
                    .acf-fields > .acf-field input, 
                    .acf-fields > .acf-field textarea, 
                    .acf-fields > .acf-field select {
                        background-color: #fff !important;
                        color: #000 !important;
                        opacity: 1 !important;
                        cursor: text !important;
                        pointer-events: auto !important;
                    }
                `;
                document.head.appendChild(style);
            }, 1000);
        });
    ');
}
add_action('enqueue_block_editor_assets', 'enqueue_block_editor_fixes'); 