<?php

class Klant_Admin_Columns {

    public function __construct() {

        /* Voegt kolommen toe */
        add_filter( 'manage_klant_posts_columns', [$this, 'add_columns']);

        /* Vult de kolommen met de juiste data */
        add_action( 'manage_klant_posts_custom_column', [$this, 'fill_columns'], 10, 2);

        /* Maakt de kolommen sorteerbaar */
        add_filter( 'manage_edit-klant_sortable_columns', [$this, 'sortable_columns']);

        /* Sorteert de kolommen */
        add_action( 'pre_get_posts', [$this, 'sort_columns']);
    
    }


    public function add_columns($columns) {

        $columns = [
            'cb' => $columns['cb'],  /* checkbox */
            'title' => 'Bedrijfsnaam',
            'sector' => 'Sector',
            'contactpersoon' => 'Contactpersoon',
            'actieve_klant' => 'Actieve Klant',
            'klant_sinds' => 'Klant Sinds',
            'date' => 'Datum'
        ];

        return $columns; /* geeft de nieuwe kolommen terug */
    }


    public function fill_columns($column, $post_id) {

        switch ($column) {  /* switch is het zelfde als een reeks if statements en wordt gebruikt als er meerdere mogelijkheden zijn */

            /* case staat voor 1 van de mogelijkheden */
            case 'sector':

                $terms = get_the_terms($post_id, 'sector');

                if ($terms && !is_wp_error($terms)) {
                    echo esc_html($terms[0]->name);
                }

            break;


            case 'contactpersoon':

                if (have_rows('contactpersonen', $post_id)) {
                    the_row(); /* pakt de eerste rij */
                    echo esc_html(get_sub_field('contact_naam'));
                }

            break;


            case 'actieve_klant':

                $actief = get_field('actieve_klant', $post_id);

                echo $actief ? 'Ja' : 'Nee';

            break;


            case 'klant_sinds':

                $datum = get_field('klant_sinds', $post_id);

                if ($datum) {
                    echo esc_html(date('d-m-Y', strtotime($datum)));
                }

            break;

        }
    }


    public function sortable_columns($columns) {

        $columns['ttle'] = 'title';
        $columns['klant_sinds'] = 'klant_sinds';

        return $columns;
    }


    public function sort_columns($query) {

        if (!is_admin()) {
            return;
        }

        if ($query->get('orderby') === 'klant_sinds') {

            $query->set('meta_key', 'klant_sinds');
            $query->set('orderby', 'meta_value');
        }

    }
           
}
