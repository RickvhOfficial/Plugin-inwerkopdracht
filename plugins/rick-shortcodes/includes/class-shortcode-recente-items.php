<?php
if ( !defined('ABSPATH')) exit; /* voorkomt toegang vanaf browser */

class Shortcode_Recente_Items {

    public function __construct() {
        add_shortcode( 'recente_items', [ $this, 'render' ]);
    }

    public function render( $atts ) {

        /* default waarden voor de shortcode */
        $atts = shortcode_atts([
            'type' => 'post',
            'aantal' => 6,
            'kolommen' => 3,
            'toon_datum' => 'ja',
            'toon_excerpt' => 'ja', /* toont korte inleiding */
            'categorie' => ''
        ], $atts, 'recente_items' );

        $type = sanitize_key($atts['type']);

        if( ! post_type_exists( $type ) ) {
            return 'error: ongeldige post type';
        }

       $aantal = max( 6, min( intval($atts['aantal']), 12 ) );

        $kolommen = intval($atts['kolommen']);
        if( ! in_array($kolommen, [1,2,3,4] ) ) {
            $kolommen = 3;
        }

        $args = [
            'post_type' => $type,
            'posts_per_page' => $aantal,
        ];

        if( ! empty( $atts['categorie']) ) {
            $args['category_name'] = sanitize_text_field($atts['categorie']);
        }

        $query = new WP_Query($args); /* query voor de posts */

        $output = '<div class="grid grid-cols-' . esc_attr($kolommen) . ' gap-4">';

        if( $query->have_posts() ) { /* posts zijn de berichten in wp-admin */

            while( $query->have_posts() ) {
                $query->the_post();

                $output .= '<div class="item border p-4">';

                if( has_post_thumbnail() ) {
                    /* afbeelding toont */
                    $output .= get_the_post_thumbnail( get_the_ID(), 'medium' );
                } else {
                    /* placeholder afbeelding */
                    $output .= '<img src="' . esc_url( get_template_directory_uri() . 'placeholder.png') . '" alt="placeholder">';
                }

                $output .= '<h3><a href="' . esc_url( get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3>';

                if ( $atts['toon_datum'] === 'ja' ) {
                    $output .= '<p>' . esc_html(get_the_date()) . '</p>';
                }

                if ($atts['toon_excerpt'] === 'ja' ) {
                    $output .= '<p>' . esc_html(get_the_excerpt()) . '</p>';
                }

                $output .= '</div>';

            }
        }
$output .= '</div>';

wp_reset_postdata(); /* reset de query */

return $output; /* return de output */

    }
}
