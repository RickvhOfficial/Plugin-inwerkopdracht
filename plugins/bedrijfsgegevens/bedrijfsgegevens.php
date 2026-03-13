<?php
/**
 * Plugin Name: Bedrijfsgegevens
 * Description: Beheer bedrijfsinformatie via ACF Options Page en toon deze via shortcodes.
 * Version: 1.0
 * Author: Rick
 */

if ( ! defined( 'ABSPATH' ) ) { /* voorkomt toegang vanaf browser */
    exit;
}

class Bedrijfsgegevens_Plugin {

	public function __construct() {

		$this->includes();
		$this->init_classes();

	}

	/**
	 * Plugin bestanden laden
	 */
	private function includes() {

		require_once plugin_dir_path( __FILE__ ) . 'includes/class-options-page.php';
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-bedrijfsgegevens-helper.php';
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-bedrijfsgegevens-shortcodes.php';

	}

	/**
	 * Classes activeren
	 */
	private function init_classes() {

		new BG_Options_Page();
		new BG_Bedrijfsgegevens_Shortcodes();

	}

}

/**
 * Plugin starten
 */
function bedrijfsgegevens_init() {

	new Bedrijfsgegevens_Plugin();

}

add_action( 'plugins_loaded', 'bedrijfsgegevens_init' );

/**
 * Activatie hook
 */
function bedrijfsgegevens_activate() {

	flush_rewrite_rules();

}

register_activation_hook( __FILE__, 'bedrijfsgegevens_activate' );