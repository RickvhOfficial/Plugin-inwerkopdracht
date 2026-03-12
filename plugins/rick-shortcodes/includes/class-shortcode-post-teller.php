<?php
if ( !defined('ABSPATH')) exit; /* voorkomt toegang vanaf browser */

class Shortcode_Post_Teller {

    public function __construct() {
        add_shortcode( 'post_teller', [ $this, 'render' ]);
 
    /* cache legen bij post save en delete */
    add_action( 'save_post', [ $this, 'clear_cache' ] );
    add_action( 'deleted_post', [ $this, 'clear_cache' ] );
   }

    public function render( $atts ) {
        $atts = shortcode_atts([
            'type'        => '',
            'status'      => 'publish', 
            'prefix'      => '',
            'suffix'      => '',
            'meta_key'    => '',
            'meta_value'  => '',
        ], $atts, 'post_teller' );

        /* controleert of het post type bestaat */
        if ( empty( $atts['type'] ) || ! post_type_exists( $atts['type'] ) ) {
            return '<span>Ongeldig post type</span>';
        }

        /* maakt een unieke transient key */
        /* md5 maakt een hash van de atts */
        $transient_key = 'post_teller_' . md5(json_encode($atts) );

        /* haalt de count op uit de transient(cache) */
        $count = get_transient( $transient_key );

        if ( false === $count ) {

            if ( empty( $atts['meta_key'] ) ) {
                $counts = wp_count_posts($atts['type'] );
                $count = isset( $counts->{$atts['status']} ) ? $counts->{$atts['status']} : 0;
            } else {
                $query = new WP_Query([
                    'post_type'      => $atts['type'],
                    'post_status'    => $atts['status'],
                    'meta_key'       => $atts['meta_key'],
                    'meta_value'     => $atts['meta_value'],
                    'posts_per_page' => 1,
                    'fields'         => 'ids',
                ]);

                $count = $query->found_posts;
                wp_reset_postdata();
            }
            /* zet de count in de transient(cache) */
            set_transient( $transient_key, $count, HOUR_IN_SECONDS );
        }

        /* returnt de count met prefix en suffix */
        return '<br><span>' . esc_html( $atts['prefix'] . $count . $atts['suffix'] ) . '</span>';
    }

    public function clear_cache( $post_id ) {

        global $wpdb;

        /* haalt de transients op */
        $transients = $wpdb->get_col(
            "SELECT option_name FROM $wpdb->options
            WHERE option_name LIKE '_transient_post_teller_%'"
        );

        /* delete de transients */
        if ( $transients ) {
            foreach ( $transients as $transient ) {
                delete_transient( str_replace( '_transient_', '', $transient ) );
            }
        }
    }
}