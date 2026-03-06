<?php
/**
 * Theme Functions
 * 
 * Laadt alleen de vereiste bestanden voor de themafunctionaliteit.
 * Alle functionaliteit is onderverdeeld in aparte bestanden in de includes map
 * voor een beter georganiseerde codebase.
 */

// Laad het composer autoloader bestand als het bestaat
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Laad ACF blocks definities
require_once 'acf_blocks.php'; 

// Load all necessary includes
$includes = [
    'includes/gravityforms-validatie.php',
    'includes/custom-post-types.php',
    'includes/theme-setup.php',
    'includes/enqueue-scripts.php',
    'includes/class-custom-walker.php',
    'includes/acf-blocks-loader.php',
    'includes/popup-scripts.php',
    'includes/theme-customizer.php',
    'includes/editor-styles.php',
    'includes/acf-block-examples.php',
    'includes/woocommerce-product.php'
];

// Pas automatisch SEO-titel aan voor Portfolio items
add_filter('wpseo_title', function($title) {
    if (is_singular('portfolio')) { // check of we een portfolio-item bekijken
        $title = 'Portfolio: ' . get_the_title() . ' | ' . get_bloginfo('name');
    }
    return $title;
});

foreach ($includes as $file) {
    if (file_exists(get_template_directory() . '/' . $file)) {
        require_once get_template_directory() . '/' . $file;
    }
}

