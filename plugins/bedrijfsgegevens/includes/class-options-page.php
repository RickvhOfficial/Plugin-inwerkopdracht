<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BG_Options_Page {

	public function __construct() {

		add_action( 'acf/init', [ $this, 'register_options_page' ] );

	}

	public function register_options_page() {

		if ( ! function_exists( 'acf_add_options_page' ) ) {
			return;
		}

		/* toevoegen van de options page */
		acf_add_options_page([
			'page_title' => 'Bedrijfsinstellingen',
			'menu_title' => 'Bedrijf',
			'menu_slug'  => 'bedrijfsinstellingen',
			'capability' => 'manage_options',
			'icon_url'   => 'dashicons-building',
			'position'   => 81,
            'redirect'   => false
		]);

		/* toevoegen van de sub page */
		acf_add_options_sub_page([
			'page_title'  => 'Social Media',
			'menu_title'  => 'Social Media',
			'parent_slug' => 'bedrijfsinstellingen'
		]);

	}

}