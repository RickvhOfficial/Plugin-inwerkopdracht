<?php
class Klant_Shortcodes {

    public function __construct() {
        add_shortcode('klanten_overzicht', [$this, 'klanten_overzicht']);
        add_shortcode('klant_detail', [$this, 'klant_detail']);
        add_shortcode('klanten_zoek', [$this, 'klanten_zoek']);
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
            echo '<div class="grid grid-cols-5 md:grid-cols-5 gap-4">';

            while ($query->have_posts()) {
                $query->the_post();

                echo '<div class="border-2 border-gray-300 rounded-md p-4">';
                echo '<h3 class="font-bold text-lg mb-2">' . get_the_title() . '</h3>';

                $logo = get_field('bedrijfslogo');
                if ($logo) {
                    echo '<img class="w-full h-auto object-cover mb-2" src="' . esc_url($logo['url']) . '" alt="' . esc_attr($logo['alt']) . '">';
                }

                echo '<p>Beschrijving: ' . esc_html(get_field('korte_beschrijving')) . '</p>';

                $sectoren = get_the_terms(get_the_ID(), 'sector');
                if ($sectoren && !is_wp_error($sectoren)) {
                    echo '<p>Sector: ' . esc_html($sectoren[0]->name) . '</p>';
                }

                echo '</div>'; 
            }

            echo '</div>';
        } else {
            echo '<p class="text-center text-2xl font-bold w-full bg-red-500 text-white p-4">Geen klanten gevonden</p>';
        }

        /* dit reset de global post data */
        wp_reset_postdata();

        /* haalt alle HTML uit de buffer en geeft het terug als string aangezien een shortcode altijd een string moet returnen*/
        return ob_get_clean();
    }


    public function klant_detail($atts) {
        /* attributen instellen */
        $atts = shortcode_atts([
            'id' => 0
        ], $atts);

        ob_start(); /* start output buffering */

        $post_id = absint($atts['id']); /* zorgt dat het ID een getal is */

        if (!$post_id) {
            echo '<p class="text-center text-2xl font-bold w-full bg-red-500 text-white p-4">Geen klant ID opgegeven.</p>';
            return ob_get_clean();
        }

        $post = get_post($post_id);

        if (!$post || $post->post_type !== 'klant') {
            echo '<p class="text-center text-2xl font-bold w-full bg-red-500 text-white p-4">Ongeldige klant.</p>';
            return ob_get_clean();
        }
        echo '<div class="grid grid-cols-5 md:grid-cols-5 gap-4 max-h-md">';
        echo '<div class="border-2 border-gray-300 rounded-md p-4 max-w-xl">';

        echo '<h2 class="text-2xl font-bold mb-4">' . get_the_title($post_id) . '</h2>';

        $bedrijfsnaam = get_field('bedrijfsnaam', $post_id);
        if ($bedrijfsnaam) {
            echo '<p>Bedrijfsnaam: ' . esc_html($bedrijfsnaam) . '</p>';
        }

        $logo = get_field('bedrijfslogo', $post_id);
        if ($logo) {
            echo '<img src="' . esc_url($logo['url']) . '" alt="' . esc_attr($logo['alt']) . '" class="w-full h-auto mb-4">';
        }

        $website = get_field('website', $post_id);
        if ($website) {
            echo '<p>Website: <a href="' . esc_url($website) . '" target="_blank">' . esc_html($website) . '</a></p>';
        }

        $beschrijving = get_field('korte_beschrijving', $post_id);
        if ($beschrijving) {
            echo '<p>Beschrijving: ' . esc_html($beschrijving) . '</p>';
        }

        $klant_sinds = get_field('klant_sinds', $post_id);
        if ($klant_sinds) {
            echo '<p>Klant sinds: ' . date_i18n('d/m/Y', strtotime($klant_sinds)) . '</p>';
        }

        if (have_rows('contactpersonen', $post_id)) {
            echo '<h3>Contactpersonen: </h3><ul>';
            while (have_rows('contactpersonen', $post_id)) {
                the_row();
                $naam = get_sub_field('contact_naam');
                $email = get_sub_field('contact_email');
                $telefoon = get_sub_field('contact_telefoon');
                $functie = get_sub_field('contact_functie');

                echo '<li>';
                echo esc_html($naam) . ' (' . esc_html($functie) . ')';
                if ($email) echo ' - <a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
                if ($telefoon) echo ' - ' . esc_html($telefoon);
                echo '</li>';
            }
            echo '</ul>';
        }

        $projecten = get_field('gerelateerde_projecten', $post_id);
        if ($projecten) {
            echo '<h3>Gerelateerde projecten: </h3><ul>';
            foreach ($projecten as $project) {
                echo '<li><a href="' . get_permalink($project->ID) . '">' . get_the_title($project->ID) . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }

        echo '</div>';

        return ob_get_clean();
    }

    public function klanten_zoek() {

        ob_start();

        $sectoren = get_terms([
            'taxonomy' => 'sector',
            'hide_empty' => false
        ]);
        ?>

        <form method="GET">
            <?php wp_nonce_field('klanten_zoek_nonce', 'klanten_nonce'); ?>

            <input type="text" name="zoekterm" placeholder="Zoek klanten"
                value="<?php echo isset($_GET['zoekterm']) ? esc_attr(sanitize_text_field($_GET['zoekterm'])) : ''; ?>">

            <select name="sector">
                <option value="">Alle sectoren</option>
                <?php foreach ($sectoren as $sector): ?>
                    <option value="<?php echo esc_attr($sector->slug); ?>" <?php selected(isset($_GET['sector']) ? $_GET['sector'] : '', $sector->slug); ?>>
                        <?php echo esc_html($sector->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Zoeken</button>
        </form>

        <?php
        if (
            isset($_GET['klanten_nonce']) &&
            wp_verify_nonce($_GET['klanten_nonce'], 'klanten_zoek_nonce')
        ) {
            $zoekterm = isset($_GET['zoekterm'])
                ? sanitize_text_field($_GET['zoekterm'])
                : '';

            $sector = isset($_GET['sector'])
                ? sanitize_text_field($_GET['sector'])
                : '';

            $args = [
                'post_type' => 'klant',
                's' => $zoekterm, /* s is de wordpress zoekparameter */
                'posts_per_page' => -1,
            ];

            if (!empty($sector)) {
                $args['tax_query'] = [
                    [
                        'taxonomy' => 'sector',
                        'field' => 'slug',
                        'terms' => $sector,
                    ]
                ];
            }

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                echo '<ul>';
                while ($query->have_posts()) {
                    $query->the_post();
                    echo '<li>' . get_the_title() . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p class="text-center text-2xl font-bold w-full bg-red-500 text-white p-4">Geen klanten gevonden</p>';
            }

            wp_reset_postdata();
        }

        return ob_get_clean();
    }
}

/* Zorgt ervoor dat wordpress de class ziet en deze kan gebruiken */
new Klant_Shortcodes();
