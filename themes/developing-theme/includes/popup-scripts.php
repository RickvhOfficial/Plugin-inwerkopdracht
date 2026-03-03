<?php
/**
 * Popup en Flowbite Scripts
 * 
 * Laadt de benodigde scripts en stijlen voor popups en Flowbite UI
 */

// Flowbite en popup scripts laden
function enqueue_popup_files() {
    // Flowbite CSS en JS
    wp_enqueue_style('flowbite', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css');
    wp_enqueue_script('flowbite', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_popup_files'); 