<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* WP_List_Table is een WordPress core class */
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Offerte_List_Table extends WP_List_Table {

    public function __construct() {
        parent::__construct([
            'singular' => 'offerte', 
            'plural'   => 'offertes', 
            'ajax'     => false       
        ]);
    }

    /*
     * Definieert de kolommen
     */
    public function get_columns(): array {
        return [
            'cb'             => '<input type="checkbox" />', /* voor bulk actions */
            'id'             => 'ID',
            'naam'           => 'Naam',
            'email'          => 'E-mail',
            'bedrijfsnaam'   => 'Bedrijf',
            'type_aanvraag'  => 'Type',
            'budget'         => 'Budget',
            'status'         => 'Status',
            'aangemaakt_op'  => 'Datum',
        ];
    }

    /* 
     * Haalt data op en stelt paginering in
     */
    public function prepare_items(): void {

        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable];

        $per_page     = 20;
        $current_page = $this->get_pagenum();

        /* Sorteerd parameters */
        $orderby = (!empty($_GET['orderby'])) ? sanitize_text_field($_GET['orderby']) : 'aangemaakt_op';
        $order   = (!empty($_GET['order'])) ? sanitize_text_field($_GET['order']) : 'DESC';
        $status  = $_GET['status_filter'] ?? '';
        /* Filtert de arguments voor Offerte_Database */
        $args = [
            'orderby' => $orderby,
            'order'   => $order,
            'limit'   => $per_page,
            'offset'  => ($current_page - 1) * $per_page,
            'status'  => sanitize_text_field($status),
        ];

        $this->items = Offerte_Database::get_all($args);

        /* Paginering instellen */
        $total_items = count(Offerte_Database::get_all(['status' => $status]));

        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil($total_items / $per_page),
        ]);
    }

    /*
     * Default kolom inladen
     */
    protected function column_default( $item, $column_name ) {
        return isset($item->$column_name) ? esc_html($item->$column_name) : '';
    }

    /*
     * Naam kolom met inline row actions
     */
    protected function column_naam($item): string {
        $actions = [
            'view'   => sprintf('<a href="#">Bekijken</a>'),
            'delete' => sprintf('<a href="?page=offertes&action=delete&offerte=%d&_wpnonce=%s">Verwijderen</a>', $item->id, wp_create_nonce('delete-offerte')),
        ];

        return sprintf('%1$s %2$s', esc_html($item->naam), $this->row_actions($actions));
    }

    /*
     * Status kolom met kleur badges
     */
    protected function column_status( $item ) {

        $statuses = [
            'nieuw',
            'in_behandeling',
            'offerte_verstuurd',
            'afgerond',
            'afgewezen'
        ];
    
        $html = '<select class="offerte-status-select" data-offerte-id="' . esc_attr( $item->id ) . '">';
    
        foreach ( $statuses as $status ) {
    
            $selected = selected( $item->status, $status, false );
    
            $html .= '<option value="' . esc_attr( $status ) . '" ' . $selected . '>'
                    . esc_html( ucfirst( str_replace('_',' ',$status) ) )
                    . '</option>';
        }
    
        $html .= '</select>';
    
        return $html;
    }

    /*
     * Sortable columns
     */
    public function get_sortable_columns(): array {
        return [
            'naam'          => ['naam', false],
            'status'        => ['status', false],
            'aangemaakt_op' => ['aangemaakt_op', false],
        ];
    }

    /*
     * Bulk actions dropdown
     */
    public function get_bulk_actions(): array {
        return ['delete' => 'Verwijderen'];
    }

    /*
     * Verwerk bulk acties
     */
    public function process_bulk_action(): void {

        /* Check of de huidige actie 'delete' is */
        if ( 'delete' === $this->current_action() && ! empty($_POST['bulk-delete']) ) {
    
            /* Nonce check voor veiligheid */
            if ( ! isset($_POST['_wpnonce']) || ! wp_verify_nonce($_POST['_wpnonce'], 'bulk-offerte') ) {
                wp_die('Nonce check mislukt');
            }
    
            /* Loop door geselecteerde IDs en verwijder uit database */
            foreach ($_POST['bulk-delete'] as $id) {
                Offerte_Database::delete((int)$id);
            }
    
            /* Toont een admin notice */
            add_action('admin_notices', function() {
                echo '<div class="notice notice-success is-dismissible"><p>Geselecteerde offertes zijn verwijderd.</p></div>';
            });
        }
    }

    /*
     * Extra tablenav: status filter dropdown
     */
    protected function extra_tablenav($which): void {

        if ($which === 'top') {

            $counts = Offerte_Database::count_by_status();
            $total  = array_sum($counts);

            echo '<div class="tablenav top"><ul class="subsubsub">';

            /* Alle link */
            $all_class = empty($_GET['status_filter']) ? ' class="current"' : '';
            echo '<li><a href="' . esc_url(remove_query_arg('status_filter')) . '"' . $all_class . '>Alle (' . $total . ')</a> | </li>';

            $last_key = array_key_last($counts);
            foreach ($counts as $status => $count) {
                $class = (isset($_GET['status_filter']) && $_GET['status_filter'] === $status) ? ' class="current"' : '';
                echo '<li><a href="' . esc_url(add_query_arg('status_filter', $status)) . '"' . $class . '>' . ucfirst(str_replace('_', ' ', $status)) . ' (' . $count . ')</a>';
                if ($status !== $last_key) echo ' | ';
                echo '</li>';
            }

            echo '</ul></div>';
        }
    }

    /*
     * Checkbox kolom voor bulk acties
     */
    protected function column_cb( $item ): string {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%d" />',
            $item->id
        );
    }

}