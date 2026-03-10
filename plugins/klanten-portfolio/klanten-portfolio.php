<?php
/**
 * Plugin Name: Klanten Portfolio CPT
 * Description: Registreert het Klanten Portfolio custom post type.
 * Version:     1.0.0
 * Author:      Rick van Houten
 */ 
 

// Verplicht in elke plugin: voorkomt dat dit bestand direct via de browser wordt aangeroepen.
// ABSPATH is een constante die WordPress definieert. Als die er niet is, draait dit buiten WP.


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hoofd plugin class
 */
class Klanten_Portfolio {
    public function __construct() {
        // benodigde bestanden laden
        $this->includes();

        // classes starten
        $this->init_classes();
    }

    /**
     * Inladen van de bestanden in de includes map
     */
    private function includes() {

        require_once plugin_dir_path( __FILE__ ) . 'includes/class-klant-cpt.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-klant-shortcodes.php';
        // require_once plugin_dir_path( __FILE__ ) . 'includes/class-klant-admin-columns.php';
    
    }

    /**
     * activeren van de classes 
     */ 
    private function init_classes() {

        new Klant_CPT();
        new Klant_Shortcodes();
        // new Klant_Admin_Columns();
    }
}

 /**
  * Plugin starten
  */
  function klanten_portfolio_init() {
    new Klanten_Portfolio();
  }    

  add_action( 'plugins_loaded', 'klanten_portfolio_init' );

  /**
   * Activatie hook
   */
  function klanten_portfolio_activate() {
    /* Dit zorgt dat WordPress de URL structuur opnieuw opbouwt wanneer de plugin geactiveerd wordt */
    flush_rewrite_rules();
  }

  register_activation_hook( __FILE__, 'klanten_portfolio_activate' );
