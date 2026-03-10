<?php
class Klant_Shortcodes {

    public function __construct() {
        add_shortcode('klanten_overzicht', [$this, 'klanten_overzicht']);
}

    public function klanten_overzicht($atts) {

        /* $atts staat voor attributes, dit is een array met alle attributen van een shortcode */
        $atts = shortcode_atts([
            'sector' => '',
            'aantal' => 10,
            'actief' => 'ja',
            'orderby' => 'title',
        ], $atts);

        /* Begin output buffering */
        ob_start();

        /* $args is een veel gebruikte naam om te bepalen welke posts wordpress moet ophalen */
        $args = [
            'post_type' => 'klant',
            'posts_per_page' => $atts['aantal'],
            'orderby' => $atts['orderby']
        ];

        /* checkt of de shortcode een sector parameter heeft gekregen*/
        if (!empty($atts['sector'])) {
            $args['tax_query'] = [ /* tax_query filterd posts op een taxonomy */
                [
                    'taxonomy' => 'sector',
                    'field' => 'slug',
                    'terms' => $atts['sector'] /* de waarde waar op gefilterd wordt */
                ]
            ];

            if ($atts['actief'] === 'ja') { /* checkt de shortcode parameter */
                $args['meta_query'] = [
                    [
                        'key' => 'actieve_klant',
                        'value' => 'ja',
                        'compare' => '='
                    ]
                ];
            }
        }

        /* Hier wordt de query gemaakt */
        $query = new WP_Query($args);

        /* checkt of er klanten gevonden zijn */
        if ($query->have_posts()) {
            echo '<div class="grid grid-cols-3 gap-4">';

            while ($query->have_posts()) {
                $query->the_post();

                echo '<div>';
                echo '<h3>' . get_the_title() . '</h3>';
                $logo = get_field('bedrijfslogo');
                if ($logo) {
                    echo '<img src="' . esc_html($logo['url']) . '" alt="' . esc_attr($logo['alt']) . '">';
                }
                echo '<p>' . esc_html(get_field('korte_beschrijving')) . '</p>';

                $sectoren = get_the_terms(get_the_ID(), 'sector');

                if ($sectoren && !is_wp_error($sectoren)) {
                    echo '<p>Sector: ' . esc_html($sectoren[0]->name) . '</p>';
                }
                
            }

           echo '</div>';
        } else {
            echo '<p>Geen klanten gevonden</p>';
        }

        /* dit reset de global post data */
        wp_reset_postdata();

        /* haalt alle HTML uit de buffer en geeft het terug als string aangezien een shortcode altijd een string moet returnen*/
        return ob_get_clean();
    }
}

/* Zorgt ervoor dat wordpress de class ziet en deze kan gebruiken */
new Klant_Shortcodes();