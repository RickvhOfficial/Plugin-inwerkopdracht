<?php
if ( ! defined( 'ABSPATH' ) ) exit;  /* voorkomt toegang vanaf browser */

class Shortcode_Sitemap {

    public function __construct() {
        add_shortcode( 'sitemap_lijst', [ $this, 'render' ] );
    }

    public function render( $atts ) {

        $atts = shortcode_atts([
            'post_types'   => 'page',
            'toon_aantal'  => 'nee',
            'max_per_type' => 50
        ], $atts, 'sitemap_lijst');


        /* haal de post types op */
        $post_types_objects = get_post_types(['public'=>true],'objects');

        /* maak een array van de post types */
        $post_types = array_map('trim', explode(',', $atts['post_types']));

        $output = '';

        /* loopt door de post types */
        foreach ( $post_types as $type ) {

            if ( ! isset( $post_types_objects[$type] ) ) {
                continue;
            }
            /* hier haal ik de posts op */
            $posts = get_posts([
                'post_type' => $type,
                'numberposts' => intval($atts['max_per_type']),
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC'
            ]);

            /* hier haal ik de label op */
            $label = $post_types_objects[$type]->labels->name;

            if ( $atts['toon_aantal'] === 'ja' ) {
                $label .= ' (' . count($posts) . ')';
            }

            $output .= '<h3>' . esc_html($label) . '</h3>';

            if ( is_post_type_hierarchical($type) ) {

                $output .= $this->render_children($posts);

            } else {

                $output .= '<ul>';

                foreach ( $posts as $post ) {

                    $output .= '<li>';
                    $output .= '<a href="'.esc_url(get_permalink($post)).'">';
                    $output .= esc_html(get_the_title($post));
                    $output .= '</a>';
                    $output .= '</li>';

                }

                $output .= '</ul>';

            }

        }

        return $output;

    }

    private function render_children( $posts, $parent = 0 ) {

        $output = '';

        /* hier haal ik de pagina's op die passen bij de categorie */
        $children = array_filter($posts, function($post) use ($parent) {
            return $post->post_parent == $parent;
        });

        if ( empty($children) ) {
            return '';
        }

        $output .= '<ul>';

        
        foreach ( $children as $post ) {

            $output .= '<li>';
            $output .= '<a href="'.esc_url(get_permalink($post)).'">';
            $output .= esc_html(get_the_title($post));
            $output .= '</a>';

            $output .= $this->render_children($posts, $post->ID);

            $output .= '</li>';

        }

        $output .= '</ul>';

        return $output;
    }

}
