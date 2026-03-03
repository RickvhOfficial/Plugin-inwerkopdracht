<?php
add_action('wp_enqueue_scripts', function () {
    // Styles
    wp_enqueue_style('myfirsttheme-style', get_stylesheet_uri());
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/tailwind-output.css', [], '1.0');
    wp_enqueue_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
    
    // Scripts
    wp_enqueue_script('flowbite', get_template_directory_uri() . '/node_modules/flowbite/dist/flowbite.min.js', [], '1.0', true);
    wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
    wp_enqueue_script('app-js', get_template_directory_uri() . '/assets/js/app.js', ['jquery', 'slick', 'flowbite'], '1.0', true);
});

// Laad Tailwind CSS in de Gutenberg editor
add_action('enqueue_block_editor_assets', function() {
    wp_enqueue_style('tailwind-editor', get_template_directory_uri() . '/assets/css/tailwind-output.css', [], '1.0');
    wp_enqueue_style('flowbite-editor', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css');
    wp_enqueue_script('flowbite-editor-js', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js', array(), null, true);
    
    // Voeg specifieke CSS toe om problemen met ACF velden in de editor op te lossen
    wp_add_inline_style('tailwind-editor', '
        /* Zorg ervoor dat ACF velden bewerkbaar blijven in de editor */
        .acf-block-preview .acf-field input,
        .acf-block-preview .acf-field textarea,
        .acf-block-preview .acf-field select,
        .acf-block-fields input,
        .acf-block-fields textarea,
        .acf-block-fields select {
            background-color: #fff !important;
            color: #000 !important;
            opacity: 1 !important;
            cursor: text !important;
            pointer-events: auto !important;
        }
        
        /* Zorg ervoor dat ACF fields hun border en styling behouden */
        .acf-fields .acf-field .acf-input input,
        .acf-fields .acf-field .acf-input textarea,
        .acf-fields .acf-field .acf-input select {
            background-color: #fff !important;
            color: #000 !important;
            border: 1px solid #ccc !important;
            pointer-events: auto !important;
        }
        
        /* Zorg ervoor dat knoppen in de editor klikbaar blijven */
        .acf-fields .acf-field .acf-input .acf-button,
        .acf-fields .acf-field .acf-input .button {
            cursor: pointer !important;
            pointer-events: auto !important;
            opacity: 1 !important;
        }
    ');
});
