<?php
/**
 * Gravity Forms Hooks – Formulier ID 4
 *
 * Velden:
 *   1 – Naam (Name)
 *   2 – Email
 *   3 – Type aanvraag (Select: Website / App / Webshop)
 *   4 – Budget (Number)
 *   5 – Beschrijving (Textarea)
 *
 * Bevat:
 *   1. Custom database tabel aanmaken (eenmalig bij theme-activatie)
 *   2. Opslaan in custom tabel na inzending  → gform_after_submission
 *   3. Extra e-mail naar salesmanager bij budget > €5000 → gform_notification
 *   4. Zakelijk e-mailadres verplicht (geen gmail/hotmail) → gform_field_validation
 */

// ============================================================
// HULPFUNCTIE: controleer of Gravity Forms actief is
// ============================================================
if ( ! function_exists( 'rgar' ) ) {
    return; // Gravity Forms is niet geladen, stop hier.
}

// ============================================================
// TABEL AANMAKEN (bij activatie én automatisch als tabel ontbreekt)
// ============================================================

// Draait bij theme-activatie (fallback voor eerste activatie)
add_action( 'after_switch_theme', 'gf_aanvragen_tabel_aanmaken' );

// Draait elke init: controleer via een optie of de tabel al aangemaakt is.
// Zo hoeft dbDelta niet bij elk verzoek te draaien, maar mist de tabel nooit.
add_action( 'init', 'gf_aanvragen_tabel_check' );
function gf_aanvragen_tabel_check() {
    if ( get_option( 'gf_aanvragen_db_version' ) !== '1.0' ) {
        gf_aanvragen_tabel_aanmaken();
        update_option( 'gf_aanvragen_db_version', '1.0' );
    }
}

/**
 * Maakt de custom tabel 'wp_aanvragen' aan met dbDelta.
 * dbDelta is de WordPress-standaard voor veilige tabelcreatie/migratie.
 */
function gf_aanvragen_tabel_aanmaken() {
    global $wpdb;

    $tabel   = $wpdb->prefix . 'aanvragen';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS {$tabel} (
        id            BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        naam          VARCHAR(255)        NOT NULL,
        email         VARCHAR(255)        NOT NULL,
        type_aanvraag VARCHAR(100)        NOT NULL DEFAULT '',
        budget        DECIMAL(10,2)       NOT NULL DEFAULT 0.00,
        beschrijving  TEXT,
        aangemeld_op  DATETIME            NOT NULL,
        PRIMARY KEY  (id)
    ) {$charset};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

// ============================================================
// 1. OPSLAAN NAAR CUSTOM DATABASE TABEL
// ============================================================

add_action( 'gform_after_submission_4', 'gf_sla_aanvraag_op_in_db', 10, 2 );
/**
 * Slaat formulierdata op in de custom wp_aanvragen tabel.
 *
 * rgar( $entry, 'id' ) is de Gravity Forms helper die veilig een waarde
 * uit het entry-array ophaalt (retourneert '' als het veld niet bestaat).
 *
 * @param array $entry  Het Gravity Forms entry-object met alle veldwaarden.
 * @param array $form   Het formulier-object (meta, velden, instellingen).
 */
function gf_sla_aanvraag_op_in_db( $entry, $form ) {
    global $wpdb;

    // Haal veldwaarden op en saniteer direct; (string) cast voor PHP 8.1+ compatibiliteit
    $naam          = sanitize_text_field( (string) rgar( $entry, '1' ) );
    $email         = sanitize_email( (string) rgar( $entry, '2' ) );
    $type_aanvraag = sanitize_text_field( (string) rgar( $entry, '3' ) );
    $budget        = floatval( rgar( $entry, '4' ) );
    $beschrijving  = sanitize_textarea_field( (string) rgar( $entry, '5' ) );

    $tabel     = $wpdb->prefix . 'aanvragen';
    $resultaat = $wpdb->insert(
        $tabel,
        [
            'naam'          => $naam,
            'email'         => $email,
            'type_aanvraag' => $type_aanvraag,
            'budget'        => $budget,
            'beschrijving'  => $beschrijving,
            'aangemeld_op'  => current_time( 'mysql' ),
        ],
        [ '%s', '%s', '%s', '%f', '%s', '%s' ] // format-specifiers per kolom
    );

    if ( false === $resultaat ) {
        // Schrijf naar het server error-log zodat het debugbaar blijft
        error_log( '[GF Aanvraag] DB insert mislukt voor entry ' . rgar( $entry, 'id' ) . ': ' . $wpdb->last_error );
    }
}

// ============================================================
// 2. EXTRA NOTIFICATIE NAAR SALESMANAGER BIJ BUDGET > €5000
// ============================================================

add_filter( 'gform_notification_4', 'gf_salesmanager_notificatie', 10, 3 );
/**
 * Stuurt een extra e-mail naar de salesmanager wanneer het opgegeven
 * budget meer dan €5000 bedraagt.
 *
 * De hook gform_notification_{form_id} wordt aangeroepen voor élke
 * notificatie die GF wil versturen. We voegen hier een losse wp_mail()
 * toe en retourneren de originele notificatie ongewijzigd, zodat de
 * standaard GF-notificatie gewoon doorloopt.
 *
 * @param array $notification  De actieve GF-notificatieconfiguratie.
 * @param array $form          Het formulier-object.
 * @param array $entry         Het entry-object met alle ingezonden data.
 * @return array               De ongewijzigde notificatie.
 */
function gf_salesmanager_notificatie( $notification, $form, $entry ) {
    $budget = floatval( rgar( $entry, '4' ) );

    // Vroeg terugkeren als budget de drempel niet haalt
    if ( $budget <= 5000 ) {
        return $notification;
    }

    $naam          = sanitize_text_field( rgar( $entry, '1' ) );
    $email         = sanitize_email( rgar( $entry, '2' ) );
    $type_aanvraag = sanitize_text_field( rgar( $entry, '3' ) );
    $beschrijving  = sanitize_textarea_field( rgar( $entry, '5' ) );
    $budget_geformat = number_format( $budget, 2, ',', '.' );

    $aan      = 'rick.van.houten@developing.nl'; // ← Vervang door het echte adres
    $onderwerp = sprintf(
        '[HOGE PRIORITEIT] Aanvraag van %s – €%s',
        $naam,
        $budget_geformat
    );
    $bericht = sprintf(
        "Er is een nieuwe aanvraag binnengekomen met een hoog budget.\n\n" .
        "Naam:           %s\n" .
        "E-mail:         %s\n" .
        "Type aanvraag:  %s\n" .
        "Budget:         €%s\n\n" .
        "Beschrijving:\n%s\n\n" .
        "Bekijk de volledige inzending in het WordPress dashboard:\n%s",
        $naam,
        $email,
        $type_aanvraag,
        $budget_geformat,
        $beschrijving,
        admin_url( 'admin.php?page=gf_entries&view=entry&id=4&lid=' . rgar( $entry, 'id' ) )
    );

    wp_mail( $aan, $onderwerp, $bericht );

    // Retourneer de originele notificatie zodat GF eigen mails blijft versturen
    return $notification;
}

// ============================================================
// 3. VALIDATIE: ALLEEN ZAKELIJKE E-MAILADRESSEN (veld 2, formulier 4)
// ============================================================

add_filter( 'gform_field_validation_4_2', 'gf_valideer_zakelijk_emailadres', 10, 4 );
/**
 * Weigert e-mailadressen van gratis consumenten-providers.
 *
 * De hook 'gform_field_validation_{form_id}_{field_id}' richt zich
 * exclusief op veld 2 van formulier 4, zodat andere velden
 * niet geraakt worden.
 *
 * We controleren pas ná de ingebouwde GF e-mailvalidatie
 * (is_valid === true), zodat foutmeldingen niet dubbelop komen.
 *
 * @param array  $result  Bevat ['is_valid' => bool, 'message' => string].
 * @param mixed  $value   De door de gebruiker ingevoerde waarde.
 * @param array  $form    Het formulier-object.
 * @param object $field   Het veld-object (bevat o.a. $field->id).
 * @return array          Aangepast validatieresultaat.
 */
function gf_valideer_zakelijk_emailadres( $result, $value, $form, $field ) {
    // Als GF het adres al ongeldig verklaart, voeg geen extra fout toe
    if ( ! $result['is_valid'] ) {
        return $result;
    }

    $verboden_domeinen = [
        // Google
        'gmail.com', 'googlemail.com',
        // Microsoft
        'hotmail.com', 'hotmail.nl', 'hotmail.be',
        'outlook.com', 'outlook.nl',
        'live.com',    'live.nl',
        'msn.com',
        // Yahoo
        'yahoo.com',   'yahoo.nl',
        // Apple
        'icloud.com',  'me.com', 'mac.com',
        // Nederlandse providers
        'ziggo.nl',    'kpnmail.nl', 'upcmail.nl', 'xs4all.nl',
    ];

    // Als "Confirm Email" aanstaat geeft GF $value als array door;
    // haal dan de eerste waarde op (het eigenlijke e-mailadres).
    $email_raw = is_array( $value ) ? (string) reset( $value ) : (string) $value;
    $email     = sanitize_email( $email_raw );
    $at_pos    = strrpos( $email, '@' );

    if ( false === $at_pos ) {
        return $result; // Geen @-teken gevonden, GF handelt dit al af
    }

    $domein = strtolower( substr( $email, $at_pos + 1 ) );

    if ( in_array( $domein, $verboden_domeinen, true ) ) {
        $result['is_valid'] = false;
        $result['message']  = 'Vul een zakelijk e-mailadres in. '
            . 'Adressen van Gmail, Hotmail en andere gratis providers worden niet geaccepteerd.';
    }

    return $result;
}

// ============================================================
// 4. VALIDATIE: ALLEEN NEDERLANDS MOBIEL NUMMER (veld 8, formulier 4)
// ============================================================

add_filter( 'gform_field_validation', 'valideer_telefoonnummer', 10, 4 );

function valideer_telefoonnummer( $result, $value, $form, $field ) {

    if ( $field->id == 8 ) {

        $telefoon = trim( $value );
        $telefoon = str_replace([' ', '-'], '', $telefoon);

        if ( ! preg_match('/^(\+31|0)6[0-9]{8}$/', $telefoon) ) {

            $result['is_valid'] = false;
            $result['message']  = 'Voer een geldig Nederlands mobiel nummer in (bijv. 0612345678 of +31612345678).';

        }
    }

    return $result;
}