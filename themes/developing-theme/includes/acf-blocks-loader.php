<?php
/**
 * ACF Blocks Loader
 * 
 * Laadt automatisch alle ACF blokken uit subdirectories
 */

// Automatisch alle ACF blokken in submappen laden
function load_acf_blocks_from_subdirectories() {
    $blocks_dir = get_template_directory() . '/resources/blocks';
    
    // Controleer of de directory bestaat
    if (!is_dir($blocks_dir)) {
        return;
    }
    
    // Doorloop alle items in de blocks directory
    $items = scandir($blocks_dir);
    foreach ($items as $item) {
        // Sla . en .. over en zorg ervoor dat het een map is
        if ($item === '.' || $item === '..' || !is_dir($blocks_dir . '/' . $item)) {
            continue;
        }
        
        // Controleer of er een acf-block.php bestand in de submap bestaat
        $acf_block_file = $blocks_dir . '/' . $item . '/acf-block.php';
        if (file_exists($acf_block_file)) {
            require_once $acf_block_file;
        }
    }
}

// Voer de functie uit om blokken te laden
load_acf_blocks_from_subdirectories(); 