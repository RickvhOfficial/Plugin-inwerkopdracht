<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Offerte_Admin {

    public function __construct() {

        /* WordPress hook om admin menu items te registreren */
        add_action( 'admin_menu', [ $this, 'register_menu' ] );

    }

    /**
     * Registreert in het admin menu
     */
    public function register_menu(): void {

        add_menu_page(
            'Offertes',                     
            'Offertes',                     
            'manage_options',               
            'offerte-aanvragen',            
            [ $this, 'render_overview_page' ], 
            'dashicons-media-document',     
            26                              
        );

        add_submenu_page(
            'offerte-aanvragen',
            'Alle aanvragen',
            'Alle aanvragen',
            'manage_options',
            'offerte-aanvragen',
            [ $this, 'render_overview_page' ]
        );

        add_submenu_page(
            'offerte-aanvragen',
            'Instellingen',
            'Instellingen',
            'manage_options',
            'offerte-instellingen',
            [ $this, 'render_settings_page' ]
        );
    }

    /**
     * Overzicht pagina
     */
    public function render_overview_page(): void {

        echo '<div class="wrap">';
        echo '<h1>Offerte aanvragen</h1>';
        echo '<p>Hier komt straks de lijst met offerte aanvragen.</p>';
        echo '</div>';

    }

    /**
     * Instellingen pagina
     */
    public function render_settings_page(): void {

        echo '<div class="wrap">';
        echo '<h1>Plugin instellingen</h1>';
        echo '<p>Hier komen straks de plugin instellingen.</p>';
        echo '</div>';

    }

}