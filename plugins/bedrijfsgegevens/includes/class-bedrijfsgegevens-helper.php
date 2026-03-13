<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Helper class voor Bedrijfsgegevens
 */
class Bedrijfsgegevens {

    /**
     * Bedrijfsnaam ophalen
     */
    public static function get_bedrijfsnaam(): string {
        $naam = get_field( 'bedrijfsnaam', 'option' );
        return $naam ? (string) $naam : '';
    }

    /**
     * Footer tekst ophalen
     */
    public static function get_footer_tekst(): string {
        $tekst = get_field( 'footer_tekst', 'option' );
        return $tekst ? (string) $tekst : '';
    }

    /**
     * Telefoonnummer ophalen
     */
    public static function get_telefoon(): string {
        $telefoon = get_field( 'bedrijfs_telefoon', 'option' );
        return $telefoon ? (string) $telefoon : '';
    }

    /**
     * E-mailadres ophalen
     */
    public static function get_email(): string {
        $email = get_field( 'bedrijfs_email', 'option' );
        return $email ? (string) $email : '';
    }

    /**
     * Adres ophalen 
     */
    public static function get_adres( string $format = 'oneline' ): string {
        $adres = get_field( 'bedrijfs_adres', 'option' );
        if ( ! $adres ) return '';

        $straat     = $adres['straat'] ?? '';
        $huisnummer = $adres['huisnummer'] ?? '';
        $postcode   = $adres['postcode'] ?? '';
        $stad       = $adres['stad'] ?? '';
        $land       = $adres['land'] ?? '';

        if ( $format === 'full' ) {
            return "{$straat} {$huisnummer}<br>{$postcode} {$stad}<br>{$land}";
        }

        return "{$straat} {$huisnummer}, {$postcode} {$stad}, {$land}";
    }

    /**
     * Openingstijden ophalen 
     */
    public static function get_openingstijden(): array {
        // kijken of er een cached versie is van de openingstijden
        $cached = get_transient( 'bg_openingstijden' );
        if ( $cached !== false ) {
            return $cached; // return cached data
        }
    
        // haal data uit ACF Options Page
        $openingstijden = get_field( 'openingstijden', 'option' );
        if ( ! is_array( $openingstijden ) ) {
            $openingstijden = [];
        }
    
        // sla op in transient verloopt na 12 uur
        set_transient( 'bg_openingstijden', $openingstijden, 12 * HOUR_IN_SECONDS );
    
        return $openingstijden;
    }
    /**
     * Huidige dag ophalen
     */
    public static function get_vandaag(): string {
        $dag_map = [
            'Mon' => 'ma',
            'Tue' => 'di',
            'Wed' => 'wo',
            'Thu' => 'do',
            'Fri' => 'vr',
            'Sat' => 'za',
            'Sun' => 'zo',
        ];
        
        $dag_english = wp_date('D'); 
        $vandaag = $dag_map[ $dag_english ] ?? $dag_english;
        return $vandaag; 
    }

    /**
     * Haal de dagwaarde op uit een ACF Select veld.
     */
    private static function parse_dag_waarde( $dag_field ): string {
        if ( is_array( $dag_field ) ) {
            return strtolower( trim( $dag_field['value'] ?? '' ) );
        }
        return strtolower( trim( (string) $dag_field ) );
    }

    /**
     * Check of het nu open is
     */
    public static function is_nu_open(): bool {
        $openingstijden = self::get_openingstijden();
        if ( empty( $openingstijden ) ) return false; /* als leeg dan false geen openingstijden ingesteld */

        $vandaag = self::get_vandaag(); 
        $nu      = strtotime( wp_date( 'H:i' ) ); /* huidige tijd met uur en minuut europees format */

        foreach ( $openingstijden as $dag ) { /* loop door de openingstijden */
            if ( self::parse_dag_waarde( $dag['dag'] ) === $vandaag && ! empty( $dag['open'] ) ) {

                $van = strtotime( $dag['van'] );
                $tot = strtotime( $dag['tot'] );
                if ( $nu >= $van && $nu <= $tot ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Openingstijden van vandaag
     */
    public static function get_openingstijden_vandaag(): string {
        $openingstijden = self::get_openingstijden(); 
        $vandaag = self::get_vandaag();

        foreach ( $openingstijden as $dag ) {
            if ( self::parse_dag_waarde( $dag['dag'] ) === $vandaag ) {
                if ( empty( $dag['open'] ) ) {
                    return 'Vandaag gesloten';
                }
                return "Vandaag geopend van {$dag['van']} tot {$dag['tot']}";
            }
        }

        return 'Openingstijden onbekend';
    }

    /**
     * Social media accounts ophalen
     */
    public static function get_social_media( string $locatie = 'footer' ): array {
        $accounts = get_field( 'social_media_accounts', 'option' );
        if ( ! is_array( $accounts ) ) return [];

        $result = [];
        foreach ( $accounts as $account ) {
            if ( $locatie === 'footer' && ! empty( $account['toon_in_footer'] ) ) {
                $result[] = $account;
            }
            if ( $locatie === 'header' && ! empty( $account['toon_in_header'] ) ) {
                $result[] = $account;
            }
        }
        return $result;
    }

    /**
     * Noodcontact ophalen
     */
    public static function get_noodcontact(): array {
        return [
            'telefoon' => get_field( 'noodcontact_telefoon', 'option' ),
            'email'    => get_field( 'noodcontact_email', 'option' )
        ];
    }

    /**
     * KvK nummer ophalen
     */
    public static function get_kvk(): string {
        $kvk = get_field( 'kvk_nummer', 'option' );
        return $kvk ? (string) $kvk : '';
    }

    /**
     * BTW nummer ophalen
     */
    public static function get_btw(): string {
        $btw = get_field( 'btw_nummer', 'option' );
        return $btw ? (string) $btw : '';
    }
}