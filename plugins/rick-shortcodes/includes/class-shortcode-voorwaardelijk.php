<?php
if ( !defined('ABSPATH')) exit; /* voorkomt toegang vanaf browser */

class Shortcode_Voorwaardelijk {

    public function __construct() {
        add_shortcode( 'voorwaardelijke_content', [ $this, 'render' ]);
    }

    public function render( $atts, $content = null ) {

        $atts = shortcode_atts( [
            'rol' => '',
            'bericht' => '',
            'gast_bericht' => ''
        ], $atts, 'voorwaardelijke_content' );

        /* check of gebruiker ingelogd is */
        if ( ! is_user_logged_in() ) {
            return esc_html( $atts['gast_bericht'] );
        }

        $user = wp_get_current_user();

        if ( in_array( $atts['rol'], $user->roles ) ) {
            return do_shortcode( $content );
        }

        return esc_html( $atts['bericht'] );
    }
}