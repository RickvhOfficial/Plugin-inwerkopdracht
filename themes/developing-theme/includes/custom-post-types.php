<?php
/**
 * Custom Post Types — Developing Theme
 *
 * Dit bestand registreert ALLE custom post types en taxonomieën van het thema.
 * Het wordt automatisch geladen via de includes-array in functions.php.
 *
 * Bestandsnaam mag je zelf kiezen — de naam 'custom-post-types.php' is een
 * gangbare WordPress-conventie, maar heeft verder geen technische betekenis.
 *
 * ─────────────────────────────────────────────────────────────────────────────
 * LET OP — THEMA VS PLUGIN
 * Dit bestand registreert OOK het Portfolio CPT (zie onderaan).
 * Als je tegelijkertijd de plugin 'custom-portfolio' actief hebt,
 * proberen beide dezelfde 'portfolio' slug te registreren → conflict.
 * Kies één methode:
 *   - Thema-methode (dit bestand): deactiveer de plugin custom-portfolio.
 *   - Plugin-methode: verwijder het Portfolio-blok uit dit bestand.
 * ─────────────────────────────────────────────────────────────────────────────
 */

/**
 * Registreert alle custom post types en taxonomieën voor dit thema.
 *
 * Eén functie voor alle CPTs houdt de code overzichtelijk en voorkomt dat
 * je meerdere add_action-aanroepen voor 'init' moet bijhouden.
 */
function developing_theme_register_post_types(): void {

	// ══════════════════════════════════════════════════════════════════════════
	// POST TYPE: VACATURES
	// Oefening 4.3 — handmatig registreren via register_post_type()
	// ══════════════════════════════════════════════════════════════════════════

	$vacatures_args = array(
		'labels' => array(
			// 'name': meervoudsnaam — zichtbaar als menu-item in de admin-zijbalk
			'name'               => 'Vacatures',
			// 'singular_name': enkelvoudsnaam — gebruikt in admin-knoppen en titels
			'singular_name'      => 'Vacature',
			'add_new'            => 'Nieuwe vacature',
			'add_new_item'       => 'Nieuwe vacature toevoegen',
			'edit_item'          => 'Vacature bewerken',
			'all_items'          => 'Alle vacatures',
			'view_item'          => 'Vacature bekijken',
			'search_items'       => 'Vacatures zoeken',
			'not_found'          => 'Geen vacatures gevonden',
			'not_found_in_trash' => 'Geen vacatures in prullenbak',
		),

		// public: true — het CPT is zichtbaar in de admin EN op de front-end.
		// Dit is de "master switch" voor zichtbaarheid.
		// Zonder public: true verschijnt het CPT NIET in het admin-menu.
		'public'       => true,

		// show_ui: true — toont de admin-interface: menu-item, overzichtslijst en editor.
		// Expliciet instellen is veiliger dan afhankelijk zijn van overerving via 'public'.
		'show_ui'      => true,

		// show_in_menu: true — plaatst het CPT als zelfstandig item in de linker admin-zijbalk.
		'show_in_menu' => true,

		// has_archive: true — genereert een archiefpagina op /vacatures/
		// Alle vacature-items zijn hier te zien als overzicht.
		'has_archive'  => true,

		// show_in_rest: true — twee doelen:
		// 1. Vereist voor de Gutenberg blok-editor (zonder dit werkt alleen de klassieke editor).
		// 2. Maakt het CPT bereikbaar via de REST API: /wp-json/wp/v2/vacatures
		'show_in_rest' => true,

		// supports: welke standaard WordPress-functies beschikbaar zijn in de editor.
		// 'custom-fields' activeert de standaard WordPress meta-boxen,
		//  wat vereist is voor ACF-velden die geen eigen interface tonen.
		'supports'     => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),

		// rewrite: de URL-slug voor dit CPT.
		// Individuele vacature: /vacatures/junior-developer/
		'rewrite'      => array( 'slug' => 'vacatures' ),

		// menu_icon: Dashicons-icoon in de admin-zijbalk.
		// Alle iconen: https://developer.wordpress.org/resource/dashicons/
		'menu_icon'    => 'dashicons-businessperson',
	);

	register_post_type( 'vacatures', $vacatures_args );

	// ── Taxonomie: Afdeling (gekoppeld aan Vacatures) ─────────────────────────

	$afdeling_args = array(
		'labels' => array(
			'name'              => 'Afdelingen',
			'singular_name'     => 'Afdeling',
			'search_items'      => 'Zoek afdelingen',
			'all_items'         => 'Alle afdelingen',
			// parent_item en parent_item_colon zijn alleen zichtbaar als hierarchical true is
			'parent_item'       => 'Bovenliggende afdeling',
			'parent_item_colon' => 'Bovenliggende afdeling:',
			'edit_item'         => 'Afdeling bewerken',
			'add_new_item'      => 'Nieuwe afdeling toevoegen',
			'menu_name'         => 'Afdelingen',
		),
		'public'       => true,
		'show_ui'      => true,
		// hierarchical: true = werkt als categorieën (ouder/kind niveaus mogelijk)
		// Voorbeeld: "IT" als ouder, "Development" en "Beheer" als kind-afdelingen
		'hierarchical' => true,
		'show_in_rest' => true,
		// rewrite: archiefpagina bereikbaar op /afdeling/marketing/
		'rewrite'      => array( 'slug' => 'afdeling' ),
	);

	register_taxonomy( 'afdeling', 'vacatures', $afdeling_args );

	// ══════════════════════════════════════════════════════════════════════════
	// POST TYPE: PORTFOLIO
	// Oefening 4.3 — thema-versie (alternatief voor de plugin custom-portfolio)
	// Deactiveer de plugin 'Custom Portfolio CPT' als je deze thema-versie gebruikt.
	// ══════════════════════════════════════════════════════════════════════════

	$portfolio_args = array(
		'labels' => array(
			'name'               => 'Portfolio',
			'singular_name'      => 'Portfolio item',
			'add_new'            => 'Nieuw item',
			'add_new_item'       => 'Nieuw portfolio item toevoegen',
			'edit_item'          => 'Portfolio item bewerken',
			'all_items'          => 'Alle items',
			'view_item'          => 'Portfolio item bekijken',
			'search_items'       => 'Portfolio items zoeken',
			'not_found'          => 'Geen items gevonden',
			'not_found_in_trash' => 'Geen items in prullenbak',
		),
		'public'       => true,
		'show_ui'      => true,  
		'show_in_menu' => true,
		'has_archive'  => true,
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite'      => array( 'slug' => 'portfolio' ),
		'menu_icon'    => 'dashicons-portfolio',
	);

	register_post_type( 'portfolio', $portfolio_args );

	// ── Taxonomie: Portfolio Categorie ────────────────────────────────────────

	$portfolio_cat_args = array(
		'labels' => array(
			'name'          => 'Categorieën',
			'singular_name' => 'Categorie',
			'search_items'  => 'Zoek categorieën',
			'all_items'     => 'Alle categorieën',
			'edit_item'     => 'Categorie bewerken',
			'add_new_item'  => 'Nieuwe categorie toevoegen',
			'menu_name'     => 'Categorieën',
		),
		'public'       => true,
		'show_ui'      => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'portfolio-categorie' ),
	);

	register_taxonomy( 'portfolio_category', 'portfolio', $portfolio_cat_args );

	// ══════════════════════════════════════════════════════════════════════════
	// POST TYPE: PROJECTEN
	// Oefening ACF — CPT voor projecten met ACF Repeater, Relationship en Group
	// ══════════════════════════════════════════════════════════════════════════

	register_post_type( 'projecten', array(
		'labels' => array(
			'name'               => 'Projecten',
			'singular_name'      => 'Project',
			'add_new'            => 'Nieuw project',
			'add_new_item'       => 'Nieuw project toevoegen',
			'edit_item'          => 'Project bewerken',
			'all_items'          => 'Alle projecten',
			'view_item'          => 'Project bekijken',
			'search_items'       => 'Projecten zoeken',
			'not_found'          => 'Geen projecten gevonden',
			'not_found_in_trash' => 'Geen projecten in prullenbak',
		),
		'public'       => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'has_archive'  => true,
		'show_in_rest' => true,
		// 'custom-fields' is vereist zodat ACF zijn meta-data kan opslaan via de REST API
		'supports'     => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'rewrite'      => array( 'slug' => 'projecten' ),
		'menu_icon'    => 'dashicons-clipboard',
	) );

	// ══════════════════════════════════════════════════════════════════════════
	// POST TYPE: KLANTEN
	// Vereist voor het ACF post_object-veld 'opdrachtgever' in project_meta
	// ══════════════════════════════════════════════════════════════════════════

	register_post_type( 'klanten', array(
		'labels' => array(
			'name'               => 'Klanten',
			'singular_name'      => 'Klant',
			'add_new'            => 'Nieuwe klant',
			'add_new_item'       => 'Nieuwe klant toevoegen',
			'edit_item'          => 'Klant bewerken',
			'all_items'          => 'Alle klanten',
			'view_item'          => 'Klant bekijken',
			'search_items'       => 'Klanten zoeken',
			'not_found'          => 'Geen klanten gevonden',
			'not_found_in_trash' => 'Geen klanten in prullenbak',
		),
		'public'       => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'has_archive'  => true,
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'rewrite'      => array( 'slug' => 'klanten' ),
		'menu_icon'    => 'dashicons-businessman',
	) );
}

// 'init' is het correcte moment in de WordPress laadvolgorde om post types te registreren.
// Plugins en thema's zijn dan geladen, maar de query is nog niet uitgevoerd.
add_action( 'init', 'developing_theme_register_post_types' );
