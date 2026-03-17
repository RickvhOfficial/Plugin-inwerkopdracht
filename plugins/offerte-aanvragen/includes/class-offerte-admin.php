<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Offerte_Admin {


public function enqueue_admin_scripts($hook) {

    /* Alleen laden op de overzichtspagina van de plugin */
    if (!in_array($hook, ['toplevel_page_offerte-aanvragen', 'offerte-aanvragen_page_offerte-aanvragen'])) {
        return;
    }

    /* JS bestand voor AJAX status updates */
    wp_enqueue_script(
        'offerte-admin-js',
        plugin_dir_url(dirname(__FILE__)) . 'includes/js/offerte-admin.js', // CORRECT PAD
        ['jquery'],
        '1.0',
        true
    );

    /* Nonce wordt beschikbaar voor JS */
    wp_localize_script('offerte-admin-js', 'OfferteAjax', [
        'nonce' => wp_create_nonce('offerte_status_nonce'),
    ]);
}

    public function __construct() {

        /* WordPress hook om admin menu items te registreren */
        add_action( 'admin_menu', [ $this, 'register_menu' ] );

        /* WordPress hook voor scripts */
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
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
        
        /* Container voor AJAX meldingen */
        echo '<div id="offerte-message-container"></div>';
    
        echo '<form method="post">';
        $list_table = new Offerte_List_Table();
        $list_table->process_bulk_action();
        $list_table->prepare_items();
        $list_table->display();
        wp_nonce_field('bulk-offerte');
        echo '</form>';
    
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