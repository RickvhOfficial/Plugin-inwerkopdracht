<?php
/**
 * Plugin Name: Rick Shortcodes
 * Description: Voorbeeld plugin met 6 shortcodes.
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
class Rick_Shortcodes_Plugin {

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

        require_once plugin_dir_path( __FILE__ ) . 'includes/class-shortcode-medewerker.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-shortcode-voorwaardelijk.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-shortcode-recente-items.php';
    
    }

    /**
     * activeren van de classes 
     */ 
    private function init_classes() {

        new Shortcode_Medewerker();
        new Shortcode_Voorwaardelijk();
        new Shortcode_Recente_Items();
    }
}

 /**
  * Plugin starten
  */
  function rick_shortcodes_init() {
    new Rick_Shortcodes_Plugin();
  }    

  add_action( 'plugins_loaded', 'rick_shortcodes_init' );

  /**
   * Activatie hook
   */
  function rick_shortcodes_activate() {
    /* Dit zorgt dat WordPress de URL structuur opnieuw opbouwt wanneer de plugin geactiveerd wordt */
    flush_rewrite_rules();
  }

  register_activation_hook( __FILE__, 'rick_shortcodes_activate' );
