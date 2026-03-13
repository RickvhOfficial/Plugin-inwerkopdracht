<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shortcodes voor Bedrijfsgegevens
 */
class BG_Bedrijfsgegevens_Shortcodes {

    public function __construct() {

        // Bedrijfsnaam
        add_shortcode( 'bedrijf_naam', [ $this, 'bedrijfsnaam_shortcode' ] );

        // Footer tekst
        add_shortcode( 'bedrijf_footer_tekst', [ $this, 'footer_tekst_shortcode' ] );

        // Telefoonnummer
        add_shortcode( 'bedrijf_telefoon', [ $this, 'telefoon_shortcode' ] );

        // E-mail
        add_shortcode( 'bedrijf_email', [ $this, 'email_shortcode' ] );

        // Adres
        add_shortcode( 'bedrijf_adres', [ $this, 'adres_shortcode' ] );

        // Openingstijden vandaag
        add_shortcode( 'openingstijden_vandaag', [ $this, 'openingstijden_vandaag_shortcode' ] );

        // Open/gesloten melding
        add_shortcode( 'is_open_melding', [ $this, 'is_open_melding_shortcode' ] );

        // Openingstijden tabel
        add_shortcode( 'openingstijden_tabel', [ $this, 'openingstijden_tabel_shortcode' ] );

        // Social media links
        add_shortcode( 'social_media_links', [ $this, 'social_media_links_shortcode' ] );

        // KvK nummer
        add_shortcode( 'bedrijf_kvk', [ $this, 'kvk_shortcode' ] );

        // BTW nummer
        add_shortcode( 'bedrijf_btw', [ $this, 'btw_shortcode' ] );

        // Noodcontact telefoon
        add_shortcode( 'noodcontact_telefoon', [ $this, 'noodcontact_telefoon_shortcode' ] );

        // Noodcontact e-mail
        add_shortcode( 'noodcontact_email', [ $this, 'noodcontact_email_shortcode' ] );

    }

    /**
     * bedrijf_naam shortcode
     */
    public function bedrijfsnaam_shortcode(): string {
        return esc_html( Bedrijfsgegevens::get_bedrijfsnaam() );
    }

    /**
     * bedrijf_footer_tekst shortcode
     */
    public function footer_tekst_shortcode(): string {
        return wp_kses_post( Bedrijfsgegevens::get_footer_tekst() );
    }

    /**
     * bedrijf telefoon shortcode
     */
    public function telefoon_shortcode(): string {
    
        return esc_html( Bedrijfsgegevens::get_telefoon() );
    }

    /**
     * bedrijf email shortcode
     */
    public function email_shortcode(): string {
        $email = Bedrijfsgegevens::get_email();
        return $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : '';
    }

    /**
     * bedrijf adres shortcode
     */
    public function adres_shortcode( $atts ): string {
        $atts = shortcode_atts( [
            'format' => 'oneline'
        ], $atts, 'bedrijf_adres' );

        return Bedrijfsgegevens::get_adres( $atts['format'] );
    }

    /**
     * openingstijden vandaag shortcode
     */
    public function openingstijden_vandaag_shortcode(): string {
        return Bedrijfsgegevens::get_openingstijden_vandaag();
    }

    /**
     *  melding open/gesloten shortcode 
     */
    public function is_open_melding_shortcode( $atts ): string {
        $atts = shortcode_atts( [
            'open_tekst'    => 'Wij zijn momenteel geopend',
            'gesloten_tekst' => 'Momenteel gesloten',
            'toon_tijden'   => 'ja'
        ], $atts, 'is_open_melding' );

        $is_open = Bedrijfsgegevens::is_nu_open();
        $tekst = $is_open ? $atts['open_tekst'] : $atts['gesloten_tekst'];

        if ( $atts['toon_tijden'] === 'ja' ) {
            $tekst .= ' (' . Bedrijfsgegevens::get_openingstijden_vandaag() . ')';
        }

        return esc_html( $tekst );
    }

    /**
     * openingstijden_tabel shortcode
     */
    public function openingstijden_tabel_shortcode(): string {
        $openingstijden = Bedrijfsgegevens::get_openingstijden();
        if ( empty( $openingstijden ) ) {
            return 'Geen openingstijden ingesteld.';
        }

        $vandaag = Bedrijfsgegevens::get_vandaag();

        $html = '<table class="table-auto w-full text-sm text-center">';
        $html .= '<thead><tr><th>Dag</th><th>Openingstijden</th></tr></thead><tbody>';

        $dag_namen = [
            'ma' => 'Maandag',
            'di' => 'Dinsdag',
            'wo' => 'Woensdag',
            'do' => 'Donderdag',
            'vr' => 'Vrijdag',
            'za' => 'Zaterdag',
            'zo' => 'Zondag',
        ];

        foreach ( $openingstijden as $dag ) {
            $dag_waarde = is_array( $dag['dag'] ) ? strtolower( trim( $dag['dag']['value'] ?? '' ) ) : strtolower( trim( (string) $dag['dag'] ) );
            $dag_klas   = $dag_waarde === $vandaag ? 'font-bold bg-gray-100' : '';
            $open_text  = ! empty( $dag['open'] ) ? "{$dag['van']} - {$dag['tot']}" : '<span class="text-gray-400">Gesloten</span>';
            $dag_label  = $dag_namen[ $dag_waarde ] ?? ucfirst( $dag_waarde );

            $html .= '<tr class="' . esc_attr( $dag_klas ) . '">';
            $html .= '<td>' . esc_html( $dag_label ) . '</td>';
            $html .= '<td>' . $open_text . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table><br>';

        return $html;
    }

    /**
     * social media links shortcode
     */
    public function social_media_links_shortcode( $atts ): string {
        $atts = shortcode_atts( [
            'locatie' => 'footer'
        ], $atts, 'social_media_links' );

        $accounts = Bedrijfsgegevens::get_social_media( $atts['locatie'] );
        if ( empty( $accounts ) ) return '';

        $html = '<ul class="flex space-x-2">';
        foreach ( $accounts as $acc ) {
            $platform = esc_html( ucfirst( $acc['platform'] ?? '' ) );
            $url = esc_url( $acc['url'] ?? '' );
            if ( $url ) {
                $html .= "<li><a href='{$url}' target='_blank' rel='noopener'>{$platform}</a></li>";
            }
        }
        $html .= '</ul> <br>';

        return $html;
    }

    /**
     * bedrijf_kvk shortcode
     */
    public function kvk_shortcode(): string {
        return esc_html( Bedrijfsgegevens::get_kvk() );
    }

    /**
     * bedrijf_btw shortcode
     */
    public function btw_shortcode(): string {
        return esc_html( Bedrijfsgegevens::get_btw() );
    }

    /**
     * noodcontact_telefoon shortcode
     */
    public function noodcontact_telefoon_shortcode(): string {
        $noodcontact = Bedrijfsgegevens::get_noodcontact();
        $telefoon = $noodcontact['telefoon'] ?? '';
        return $telefoon ? '<a href="tel:' . esc_attr( $telefoon ) . '">' . esc_html( $telefoon ) . '</a>' : '';
    }

    /**
     * noodcontact_email shortcode
     */
    public function noodcontact_email_shortcode(): string {
        $noodcontact = Bedrijfsgegevens::get_noodcontact();
        $email = $noodcontact['email'] ?? '';
        return $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : '';
    }

}