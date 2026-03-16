<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Offerte_Database {

    /**
     * Maak de database tabel bij plugin activatie
     */
    public static function create_table(): void {

        global $wpdb;

        $table_name = $wpdb->prefix . 'offerteaanvragen';

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            naam VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            telefoon VARCHAR(20),
            bedrijfsnaam VARCHAR(100),
            type_aanvraag VARCHAR(50) NOT NULL,
            budget VARCHAR(50),
            omschrijving TEXT NOT NULL,
            status VARCHAR(20) DEFAULT 'nieuw',
            notities TEXT,
            aangemaakt_op DATETIME DEFAULT CURRENT_TIMESTAMP,
            bijgewerkt_op DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        dbDelta( $sql );
    }


    /**
     * Nieuwe offerte toevoegen
     */
    public static function insert( array $data ): int|false {

        global $wpdb;

        $table = $wpdb->prefix . 'offerteaanvragen';

        $result = $wpdb->insert(
            $table,
            [
                'naam'          => $data['naam'],
                'email'         => $data['email'],
                'telefoon'      => $data['telefoon'] ?? '',
                'bedrijfsnaam'  => $data['bedrijfsnaam'] ?? '',
                'type_aanvraag' => $data['type_aanvraag'],
                'budget'        => $data['budget'] ?? '',
                'omschrijving'  => $data['omschrijving'],
                'status'        => 'nieuw',
            ],
            [
                '%s', /* SQL format placeholders string */
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            ]
        );

        if ( false === $result ) {
            return false;
        }

        return (int) $wpdb->insert_id;
    }


    /**
     * Haalt een offerte op via ID
     */
    public static function get_by_id( int $id ): object|null {

        global $wpdb;

        $table = $wpdb->prefix . 'offerteaanvragen';

        $query = $wpdb->prepare(
            "SELECT * FROM $table WHERE id = %d", /* %d integer placeholder */
            $id
        );

        $result = $wpdb->get_row( $query );

        return $result ?: null;
    }


    /**
     * Haalt meerdere offertes op via verschillende filters
     */
    public static function get_all( array $args = [] ): array {

        global $wpdb;

        $table = $wpdb->prefix . 'offerteaanvragen';

        $defaults = [
            'status'  => '',
            'orderby' => 'aangemaakt_op',
            'order'   => 'DESC',
            'limit'   => 20,
            'offset'  => 0,
            'search'  => '',
        ];

        $args = wp_parse_args( $args, $defaults ); /* wp_parse_args is een wordpress functie die de args samenvoegt met de defaults */

        $where  = [];
        $values = []; 

        if ( ! empty( $args['status'] ) ) {
            $where[]  = "status = %s";
            $values[] = $args['status'];
        }

        if ( ! empty( $args['search'] ) ) {

            $where[] = "(naam LIKE %s OR email LIKE %s OR bedrijfsnaam LIKE %s)";

            $search = '%' . $wpdb->esc_like( $args['search'] ) . '%';

            $values[] = $search;
            $values[] = $search;
            $values[] = $search;
        }

        $where_sql = '';

        if ( ! empty( $where ) ) {
            $where_sql = 'WHERE ' . implode( ' AND ', $where );
        }

        $allowed_orderby = [ 'naam', 'status', 'aangemaakt_op' ];

        if ( ! in_array( $args['orderby'], $allowed_orderby, true ) ) {
            $args['orderby'] = 'aangemaakt_op';
        }

        $order = strtoupper( $args['order'] ) === 'ASC' ? 'ASC' : 'DESC'; /* strtoupper zet alle tekens om naar uppercase */

        $sql = "
            SELECT *
            FROM $table
            $where_sql
            ORDER BY {$args['orderby']} $order
            LIMIT %d
            OFFSET %d
        ";

        $values[] = (int) $args['limit'];
        $values[] = (int) $args['offset'];

        $query = $wpdb->prepare( $sql, $values );

        return $wpdb->get_results( $query ); /* haalt meerdere rijen op als array */
    }


    /**
     * Update offertes via ID
     */
    public static function update( int $id, array $data ): bool {

        global $wpdb;

        $table = $wpdb->prefix . 'offerteaanvragen';

        $result = $wpdb->update(
            $table,
            $data,
            [ 'id' => $id ],
            null,
            [ '%d' ]
        );

        return false !== $result;
    }


    /**
     * Verwijder offerte
     */
    public static function delete( int $id ): bool {

        global $wpdb;

        $table = $wpdb->prefix . 'offerteaanvragen';

        $result = $wpdb->delete(
            $table,
            [ 'id' => $id ],
            [ '%d' ]
        );

        return false !== $result;
    }


    /**
     * Aantal offertes per status
     */
    public static function count_by_status(): array {

        global $wpdb;

        $table = $wpdb->prefix . 'offerteaanvragen';

        $results = $wpdb->get_results(
            "SELECT status, COUNT(*) as count
             FROM $table
             GROUP BY status"
        );

        $counts = [];

        foreach ( $results as $row ) {
            $counts[ $row->status ] = (int) $row->count;
        }

        return $counts;
    }

}