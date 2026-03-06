<?php
/**
 * WooCommerce Single Product Aanpassingen
 *
 * Hooks op woocommerce_single_product_summary (standaard prioriteiten):
 *   5  → woocommerce_template_single_title
 *  10  → woocommerce_template_single_rating
 *  10  → woocommerce_template_single_price
 *  20  → woocommerce_template_single_excerpt
 *  30  → woocommerce_template_single_add_to_cart
 *  40  → woocommerce_template_single_meta  (bevat SKU, categorieën, tags)
 *  50  → woocommerce_template_single_sharing
 *
 * Gewenste volgorde: titel → prijs → gratis-verzending tekst → korte beschrijving
 */

// Alleen uitvoeren als WooCommerce actief is.
if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}

// =============================================================================
// 1. Verberg de SKU op de single product pagina
// =============================================================================
//
// De SKU zit in het meta-blok dat wordt gerenderd door
// woocommerce_template_single_meta (prioriteit 40). Dit blok bevat
// ook categorieën en tags, dus we kunnen de functie niet zomaar
// verwijderen. In plaats daarvan gebruiken we output buffering:
// woocommerce_product_meta_start en woocommerce_product_meta_end
// omsluiten precies het meta-blok. We vangen de HTML op en
// strippen de <span class="sku_wrapper"> er tussenuit.
//
add_action( 'woocommerce_product_meta_start', function() {
    ob_start();
} );

add_action( 'woocommerce_product_meta_end', function() {
    $meta_html = ob_get_clean();
    // Verwijder alleen de SKU-wrapper; categorieën en tags blijven intact.
    echo preg_replace( '/<span class="sku_wrapper">.*?<\/span>/s', '', $meta_html );
} );

// =============================================================================
// 2. Toon "Gratis verzending" tekst onder de prijs
// =============================================================================
//
// Hook:       woocommerce_single_product_summary
// Prioriteit: 15
//   → na  de prijs          (prioriteit 10)
//   → vóór de beschrijving  (prioriteit 20)
//
add_action( 'woocommerce_single_product_summary', function() {
    echo '<p class="gratis-verzending-notice">'
        . esc_html__( 'Gratis verzending bij bestellingen boven €50', 'developing-theme' )
        . '</p>';
}, 15 );

// =============================================================================
// 3. Pas de volgorde van elementen aan
// =============================================================================
//
// Probleem: rating én price hebben beide prioriteit 10.
// WooCommerce voegt rating eerder toe dan price, waardoor
// rating als eerste verschijnt. Dat doorbreekt de gewenste volgorde.
//
// Oplossing: verwijder rating van prioriteit 10 en voeg het
// opnieuw toe op prioriteit 25 (na de beschrijving op 20,
// vóór de add-to-cart knop op 30).
//
// Resulterende volgorde:
//   5  → titel
//  10  → prijs
//  15  → gratis-verzending tekst (zie stap 2)
//  20  → korte beschrijving
//  25  → beoordeling (rating) — verplaatst
//  30  → add-to-cart knop
//  40  → meta (categorieën, tags — SKU verborgen via stap 1)
//
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 25 );


// =============================================================================
// 4. Stijl voor de gratis-verzending tekst
// =============================================================================
add_action( 'wp_head', function() {
    if ( ! is_product() ) {
        return;
    }
    ?>
    <style>
        .gratis-verzending-notice {
            display: inline-block;
            margin: 0.5em 0 1em;
            padding: 0.4em 0.8em;
            background-color: #f0faf0;
            border-left: 3px solid #4caf50;
            color: #2e7d32;
            font-size: 0.9em;
            font-weight: 600;
        }
    </style>
    <?php
} );
