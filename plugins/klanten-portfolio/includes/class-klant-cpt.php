<?php

class Klant_CPT {

    /*
    * init wordt gebruikt om de post types te laden in de WordPress laadvolgorde
    */
    public function __construct() {
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_taxonomy']);
    }
    /* Registreert het klant post type met alle benodigde instellingen */
    public function register_post_type() {
        register_post_type('klant', [
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'klanten'],
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'menu_icon' => 'dashicons-businessman',
            'labels' => [
                'name' => 'Klanten',
                'singular_name' => 'Klant',
                'add_new' => 'Nieuwe klant',
                'add_new_item' => 'Nieuwe klant toevoegen',
                'edit_item' => 'Klant bewerken',
                'view_item' => 'Bekijk klant',
                'search_items' => 'zoek klanten',
                'not_found' => 'Geen klanten gevonden',
                'all_items' => 'Alle klanten',
            ],
        ]);
    }

    public function register_taxonomy() {
        $labels = [
            'name' => 'Sectoren',
            'singular_name' => 'Sector',
            'search_items' => 'Zoek sectoren',
            'all_items' => 'Alle sectoren',
            'edit_item' => 'Sector bewerken',
            'add_new_item' => 'Nieuwe sector toevoegen',
            'menu_name' => 'Sectoren',
        ];
        
        register_taxonomy(
        'sector',     /* slug van de taxonomy */
        ['klant'],    /*  post types waaraan het gekoppeld wordt */
        [
            'hierarchical' => true,
            'labels' => $labels,
            'show_in_rest' => true,
            'rewrite' => [
                'slug' => 'sector',
            ]
        ]
    );
    }

}
/* Zorgt ervoor dat wordpress de class ziet en deze kan gebruiken */
new Klant_CPT();