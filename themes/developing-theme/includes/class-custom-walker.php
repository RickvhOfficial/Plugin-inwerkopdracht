<?php

use Walker_Nav_Menu;

/**
 * Custom walker class voor het WordPress navigatiemenu.
 */
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array|object  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' );
        $display_depth = ( $depth + 1);
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
        $output .= "$indent</ul>\n";
    }

    /**
     * Start the element output.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array|object  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Controleer of dit item submenu-items heeft
        $has_children = in_array('menu-item-has-children', $classes);
        $item_has_children_class = $has_children ? ' menu-item-has-children' : '';

        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="custom-menu-item ' . $depth_class_names . ' ' . $class_names . $item_has_children_class . '">';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        // Check of $args een object of array is
        $before = is_object($args) ? $args->before : (isset($args['before']) ? $args['before'] : '');
        $after = is_object($args) ? $args->after : (isset($args['after']) ? $args['after'] : '');
        $link_before = is_object($args) ? $args->link_before : (isset($args['link_before']) ? $args['link_before'] : '');
        $link_after = is_object($args) ? $args->link_after : (isset($args['link_after']) ? $args['link_after'] : '');

        // Voeg een dropdown indicator toe als er submenu-items zijn
        $dropdown_icon = $has_children ? '<svg class="w-4 h-4 ml-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>' : '';

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
            $before,
            $attributes,
            $link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $dropdown_icon,
            $link_after,
            $after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * Ends the element output, if needed.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
} 