<?php
/**
 * Plugin Name: Custom Portfolio CPT
 * Plugin URI:  https://example.com
 * Description: Registreert het Portfolio custom post type en de bijbehorende Categorie taxonomie.
 * Version:     1.0.0
 * Author:      Rick van Houten
 * Author URI:  https://example.com
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: custom-portfolio
 * Domain Path: /languages
 *
 * @package CustomPortfolio
 */

// Verplicht in elke plugin: voorkomt dat dit bestand direct via de browser wordt aangeroepen.
// ABSPATH is een constante die WordPress definieert. Als die er niet is, draait dit buiten WP.


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// declare( strict_types=1 );
// ─────────────────────────────────────────────────────────────────────────────
// LET OP — THEMA VS PLUGIN
// Als je de thema-methode gebruikt (developing-theme/includes/custom-post-types.php),
// zet dan DEZE plugin uit via WP Admin → Plugins → Deactiveren.
// Anders registreren beide tegelijk dezelfde 'portfolio' slug → conflict.
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Plugin-constanten: paden en versie op één centrale plek zodat je ze overal kunt gebruiken.
 * plugin_dir_path() geeft het absolute serverpad naar de pluginmap (eindigt op /).
 * plugin_dir_url() geeft de volledige URL naar de pluginmap (eindigt op /).
 */
define( 'CP_PLUGIN_VERSION', '1.0.0' );
define( 'CP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Registreert het Portfolio post type en de bijbehorende Categorie taxonomie.
 *
 * Wordt aangeroepen via de 'init' hook — het correcte moment in de WordPress
 * laadvolgorde om post types en taxonomieën te registreren.
 */
function custom_portfolio_register_cpt(): void {

	// ── Post Type: Portfolio ──────────────────────────────────────────────────

	$post_type_args = array(
		'labels' => array(
			// Meervoud — zichtbaar als menu-item in de admin-zijbalk
			'name'               => 'Portfolio',
			// Enkelvoud — gebruikt in knoppen ("Nieuw Portfolio item toevoegen")
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

		// public: true — maakt het CPT zichtbaar op de front-end én in de admin.
		// Dit is de "master switch": het erft show_ui, show_in_menu, publicly_queryable.
		'public'       => true,

		// show_ui: true — toont de admin-interface: het menu-item, het overzicht en de editor.
		// Expliciet instellen is veiliger dan vertrouwen op overerving via 'public'.
		'show_ui'      => true,

		// show_in_menu: true — plaatst het CPT als zelfstandig item in de linker admin-zijbalk.
		// Je kunt hier ook een bestaand menu-item opgeven (bijv. 'tools.php') om het eronder te nesten.
		'show_in_menu' => true,

		// has_archive: true — genereert een archiefpagina bereikbaar op /portfolio/
		// Hier verschijnen alle portfolio-items in een overzicht.
		'has_archive'  => true,

		// show_in_rest: true — vereist voor twee dingen:
		// 1. De Gutenberg (blok-)editor werkt alleen als dit true is.
		// 2. Het CPT is bereikbaar via de WordPress REST API (/wp-json/wp/v2/portfolio).
		'show_in_rest' => true,

		// supports: bepaalt welke standaard WordPress-functies beschikbaar zijn in de editor.
		// 'title'     → het titelblok bovenaan
		// 'editor'    → de inhoud/blok-editor
		// 'thumbnail' → de uitgelichte afbeelding (featured image)
		// 'excerpt'   → het samenvattingsveld
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),

		// rewrite: bepaalt de URL-structuur (slug) voor dit CPT.
		// Een enkel portfolio-item is bereikbaar op /portfolio/naam-van-item/
		'rewrite'      => array( 'slug' => 'portfolio' ),

		// menu_icon: het Dashicons-icoon dat in de admin-zijbalk wordt getoond.
		// Alle beschikbare iconen: https://developer.wordpress.org/resource/dashicons/
		'menu_icon'    => 'dashicons-portfolio',
	);

	register_post_type( 'portfolio', $post_type_args );

	// ── Taxonomie: Portfolio Categorie ────────────────────────────────────────

	$taxonomy_args = array(
		'labels' => array(
			'name'          => 'Categorieën',
			'singular_name' => 'Categorie',
			'search_items'  => 'Zoek categorieën',
			'all_items'     => 'Alle categorieën',
			'edit_item'     => 'Categorie bewerken',
			'add_new_item'  => 'Nieuwe categorie toevoegen',
			'menu_name'     => 'Categorieën',
		),

		// public: true — de taxonomie is zichtbaar in admin en op de front-end.
		'public'       => true,

		// show_ui: true — toont de taxonomie als sub-menu onder het CPT in de admin.
		'show_ui'      => true,

		// hierarchical: true — werkt als categorieën: je kunt ouder/kind-niveaus maken.
		// hierarchical: false — werkt als tags: vrij in te voeren termen zonder hiërarchie.
		'hierarchical' => true,

		// show_in_rest: true — vereist voor weergave in de Gutenberg-sidebar.
		'show_in_rest' => true,
 
		// rewrite: de URL-slug voor taxonomie-archiefpagina's.
		// Een categoriepagina is bereikbaar op /portfolio-categorie/webdesign/
		'rewrite'      => array( 'slug' => 'portfolio-categorie' ),
	);

	// register_taxonomy( $taxonomy_slug, $post_type_slug, $args )
	// Koppelt 'portfolio_category' aan het 'portfolio' post type.
	register_taxonomy( 'portfolio_category', 'portfolio', $taxonomy_args );
}

// 'init' is de juiste hook voor het registreren van post types en taxonomieën.
// Prioriteit 10 (standaard) is prima; gebruik een hogere prioriteit als je
// zeker wilt zijn dat jouw registratie ná andere plugins komt.
add_action( 'init', 'custom_portfolio_register_cpt' );

// ─────────────────────────────────────────────────────────────────────────────
// ACTIVATIE HOOK
// Wordt eenmalig aangeroepen op het moment dat de beheerder op "Activeren" klikt.
// flush_rewrite_rules() herregistreert alle URL-patronen — zonder dit geeft
// WordPress een 404 bij /portfolio/ ook al is het CPT correct geregistreerd.
// Dit is het CRUCIALE verschil met een CPT zonder activation hook.
// ─────────────────────────────────────────────────────────────────────────────
function custom_portfolio_activate(): void {
	custom_portfolio_register_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'custom_portfolio_activate' );

// ─────────────────────────────────────────────────────────────────────────────
// DEACTIVATIE HOOK
// Wordt eenmalig aangeroepen op het moment dat de beheerder op "Deactiveren" klikt.
// flush_rewrite_rules() verwijdert de /portfolio/ URL-patronen weer uit WordPress.
// ─────────────────────────────────────────────────────────────────────────────
function custom_portfolio_deactivate(): void {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'custom_portfolio_deactivate' );
