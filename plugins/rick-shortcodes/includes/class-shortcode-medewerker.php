<?php 
if ( !defined('ABSPATH')) exit; /* voorkomt toegang vanaf browser */

class Shortcode_Medewerker {

    public function __construct() {
        add_shortcode( 'medewerker_kaart', [ $this, 'render' ]);
    }

    public function render( $atts ) {
        /* standaard waarden voor id = 0 */
        $atts = shortcode_atts( [
            'id' => 0,
        ], $atts, 'medewerker_kaart' );

        $post_id = intval( $atts['id'] );
 
        /* checken of de post bestaat anders niks laten zien nu tijdelijk om gezet naar error: medewerker niet gevonden voor test */
        if ( empty($post_id) ) {
            return 'error: medewerker niet gevonden voor test';
        }
        
        $post = get_post($post_id);
        
        if ( ! $post ) {
            return 'error: medewerker niet gevonden';
        }
    
        $functietitel = get_field( 'functietitel', $post_id );
        $afdeling     = get_field( 'afdeling', $post_id );
        $telefoon     = get_field( 'telefoonnummer', $post_id );
        $foto         = get_field( 'profielfoto', $post_id); 
       
        $output = '<div class="medewerker-kaart p-4 rounded">';

        if ( $foto ) {
            /* URL ophalen uit de array uit het ACF field */
            $foto_url = $foto['sizes']['medium'] ?? $foto['url'] ?? '';
            if ( $foto_url ) {
                $output .= '<div class="medewerker-foto mb-2" style="background-image: url(' . esc_url( $foto_url ) . '); background-size: cover; background-position: center; width: 10rem; height: 10rem;"></div>';
            }
        }

        if ( $functietitel ) $output .= '<h3>' . esc_html( $functietitel ) . '</h3>';
        if ( $afdeling ) $output .= '<p>' . esc_html( $afdeling ) . '</p>';
        if ( $telefoon ) $output .= '<p>' . esc_html( $telefoon ) . '</p>';

        $output .= '</div>';

        return $output;
    }
}