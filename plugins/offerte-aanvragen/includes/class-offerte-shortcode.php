<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Offerte_Shortcode {

    public function __construct() {
        add_shortcode( 'offerte_formulier', [ $this, 'render_formulier' ] );
    }

    public function render_formulier() {

        $errors = [];
        $values = [];

        if ( isset( $_POST['offerte_submit'] ) ) {

            if ( ! isset( $_POST['offerte_nonce'] ) ||
                ! wp_verify_nonce( $_POST['offerte_nonce'], 'offerte_form_nonce' ) ) {

                return '<p>Beveiligingscontrole mislukt.</p>';
            }

            /* Honeypot check voor spam bots */
            if ( ! empty( $_POST['website'] ) ) {
                return '';
            }

            /* Velden ophalen */
            $values['naam'] = sanitize_text_field( $_POST['naam'] ?? '' );
            $values['email'] = sanitize_email( $_POST['email'] ?? '' );
            $values['telefoon'] = sanitize_text_field( $_POST['telefoon'] ?? '' );
            $values['bedrijfsnaam'] = sanitize_text_field( $_POST['bedrijfsnaam'] ?? '' );
            $values['type_aanvraag'] = sanitize_text_field( $_POST['type_aanvraag'] ?? '' );
            $values['budget'] = sanitize_text_field( $_POST['budget'] ?? '' );
            $values['omschrijving'] = sanitize_textarea_field( $_POST['omschrijving'] ?? '' );

            /* Validatie */
            if ( empty( $values['naam'] ) || strlen( $values['naam'] ) > 100 ) {
                $errors[] = 'Naam is verplicht (max 100 karakters).';
            }

            if ( ! is_email( $values['email'] ) ) {
                $errors[] = 'Voer een geldig e-mailadres in.';
            }

            $allowed_types = ['website','webshop','app','overig'];

            if ( ! in_array( $values['type_aanvraag'], $allowed_types ) ) {
                $errors[] = 'Ongeldig type aanvraag.';
            }

            if ( strlen( $values['omschrijving'] ) < 50 ) {
                $errors[] = 'Omschrijving moet minimaal 50 karakters bevatten.';
            }

            /* Geen fouten */
            if ( empty( $errors ) ) {

                $db = new Offerte_Database();

                $db->insert( $values );

                /* Mail naar klant */
                wp_mail(
                    $values['email'],
                    'Bevestiging offerte aanvraag',
                    'Bedankt voor uw aanvraag. Wij nemen binnenkort contact op.'
                );

                /* Mail naar admin */
                wp_mail(
                    get_option('admin_email'),
                    'Nieuwe offerte aanvraag',
                    'Er is een nieuwe offerte aanvraag ontvangen.'
                );

                return '<p>Bedankt! Uw aanvraag is succesvol verzonden.</p>';
            }

        }

        ob_start();

        if ( ! empty( $errors ) ) {

            echo '<ul class="offerte-errors">';
            foreach ( $errors as $error ) {
                echo '<li>' . esc_html( $error ) . '</li>';
            }
            echo '</ul>';

        }

        ?>

<div class="max-w-lg border border-gray-300 rounded-md p-6 mx-auto mt-10">
<form method="post">

<p class="mb-1">
<label>Naam *</label><br>
<input type="text" name="naam" value="<?php echo esc_attr($values['naam'] ?? ''); ?>">
</p>

<p class="mb-1">
<label>E-mailadres *</label><br>
<input type="email" name="email" value="<?php echo esc_attr($values['email'] ?? ''); ?>">
</p>

<p class="mb-1">
<label>Telefoonnummer</label><br>
<input type="text" name="telefoon" value="<?php echo esc_attr($values['telefoon'] ?? ''); ?>">
</p>

<p class="mb-1">
<label>Bedrijfsnaam</label><br>
<input type="text" name="bedrijfsnaam" value="<?php echo esc_attr($values['bedrijfsnaam'] ?? ''); ?>">
</p>
<div class="flex justify-between">
<p class="mb-1">
<label>Type aanvraag *</label><br>
<select style="width: 11rem; text-align: center;" name="type_aanvraag">
<option value="">Selecteer</option>
<option value="website">Website</option>
<option value="webshop">Webshop</option>
<option value="app">App</option>
<option value="overig">Overig</option>
</select>
</p>

<p class="mb-1">
<label>Budget indicatie *</label><br>
<select style="width: 11rem; text-align: center;" name="budget">
<option value="<1000">< 1000</option>
<option value="1000-5000">1000-5000</option>
<option value="5000-10000">5000-10000</option>
<option value=">10000">> 10000</option>
</select>
</p>
</div>
<p class="mb-1">
<label>Omschrijving *</label><br>
<textarea class="w-full" style="min-height: 6rem;" name="omschrijving"><?php echo esc_textarea($values['omschrijving'] ?? ''); ?></textarea>
</p>

<!-- Honeypot voor spam bots -->
<input type="text" name="website" style="display:none">

<?php wp_nonce_field('offerte_form_nonce','offerte_nonce'); ?>

<p class="text-center mt-4">
<button class="text-white px-4 py-2 rounded-md mb-1 hover:bg-yellow-500" style="width: 10rem; background-color: #C49B2B; font-weight: 600;" type="submit" name="offerte_submit">Versturen</button>
</p>

</form>
</div>

<?php

        return ob_get_clean();
    }
}