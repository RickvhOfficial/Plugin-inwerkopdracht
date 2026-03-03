<?php
/**
 * ACF Block Examples
 * 
 * Zorgt voor voorbeelden van ACF blocks in de editor en corrigeert preview issues
 */

// Zorg ervoor dat alle blocks automatisch een voorbeeld krijgen als ze dat nog niet hebben
function ensure_block_example($args, $block_type) {
    // Alleen voor ACF blocks zonder een example
    if (strpos($block_type, 'acf/') === 0 && !isset($args['example'])) {
        $args['example'] = array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    // Standaard placeholder data voor blocks zonder specifieke example
                    'title' => 'Voorbeeld Titel',
                    'description' => 'Dit is een voorbeeld beschrijving voor dit block. Voeg specifieke example data toe aan je block registratie voor een aangepaste preview.',
                ),
            ),
        );
    }
    return $args;
}
add_filter('register_block_type_args', 'ensure_block_example', 10, 2);

// Zorg ervoor dat velden bewerkbaar blijven na toevoegen van een block
function disable_preview_mode_on_edit($block) {
    // Verwijder de preview mode als het block al aan de pagina is toegevoegd
    if (isset($block['data']['mode']) && $block['data']['mode'] === 'preview') {
        unset($block['data']['mode']);
    }
    return $block;
}
add_filter('acf/pre_render_block', 'disable_preview_mode_on_edit', 10, 3); 