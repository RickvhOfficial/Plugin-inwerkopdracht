<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Offerte_Ajax {

    public function __construct() {
        add_action( 'wp_ajax_update_offerte_status', [ $this, 'update_offerte_status' ] );
    }

    public function update_offerte_status() {

        /* Nonce verificatie */
        check_ajax_referer( 'offerte_status_nonce', 'nonce' );

        /* Capability check */
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [ 'message' => 'Geen toestemming.' ] );
        }

        /* Input sanitizen */
        $offerte_id    = isset( $_POST['offerte_id'] ) ? intval( $_POST['offerte_id'] ) : 0;
        $nieuwe_status = isset( $_POST['nieuwe_status'] ) ? sanitize_text_field( $_POST['nieuwe_status'] ) : '';

        if ( ! $offerte_id || empty( $nieuwe_status ) ) {
            wp_send_json_error( [ 'message' => 'Ongeldige data.' ] );
        }

        /* Database update */
        $db = new Offerte_Database();

        $result = $db->update( $offerte_id, [
            'status' => $nieuwe_status
        ]);

        if ( $result === false ) {
            wp_send_json_error( [ 'message' => 'Status kon niet worden bijgewerkt.' ] );
        }

        wp_send_json_success( [
            'message' => 'Status succesvol bijgewerkt.'
        ]);
    }
}