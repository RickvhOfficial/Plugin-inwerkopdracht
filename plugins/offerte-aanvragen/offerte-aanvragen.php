<?php
/**
 * Plugin Name: Offerte Aanvragen
 * Description: Plugin voor het beheren van offerteaanvragen via een custom database tabel.
 * Version:     1.0.0
 * Author:      Rick van Houten
 */ 
 

// Verplicht in elke plugin: voorkomt dat dit bestand direct via de browser wordt aangeroepen.
// ABSPATH is een constante die WordPress definieert. Als die er niet is, draait dit buiten WP.


if ( ! defined( 'ABSPATH' ) ) { 
	exit;
}


class Offerte_Aanvragen {

    public function __construct() {

        $this->includes();
        
        add_action( 'plugins_loaded', [ $this, 'init_classes' ] );
    }

    private function includes(): void {

        require_once plugin_dir_path( __FILE__ ) . 'includes/class-offerte-database.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-offerte-admin.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-offerte-list-table.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-offerte-ajax.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-offerte-shortcode.php';

    }

    public function init_classes(): void {
        new Offerte_Admin();
        new Offerte_Ajax();
        new Offerte_Shortcode();

    }

}
register_activation_hook(
    __FILE__,
    [ 'Offerte_Database', 'create_table' ]
);

new Offerte_Aanvragen();