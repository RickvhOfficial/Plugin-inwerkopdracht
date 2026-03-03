<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article class="project-single" id="project-<?php the_ID(); ?>">

    <header class="project-header">
        <h1><?php the_title(); ?></h1>
    </header>
 
    <?php 
    // ─────────────────────────────────────────────────────────────────────────
    // get_field( $field_name, $post_id )
    //
    // Haalt de waarde op van één ACF-veld voor de huidige post (of een opgegeven
    // post-ID). WordPress slaat de raw waarde op in de database; ACF verwerkt
    // die naar het juiste PHP-type:
    //   - text / textarea  → string
    //   - number           → int / float
    //   - date_picker      → string in het formaat dat je in ACF hebt ingesteld
    //   - image            → array met 'url', 'alt', 'width', 'height', etc.
    //   - post_object      → WP_Post object (of array van objecten bij meerdere)
    //   - relationship     → array van WP_Post objecten
    //
    // Geeft false / null terug als het veld leeg is of niet bestaat.
    // ─────────────────────────────────────────────────────────────────────────

    // ── Project Meta (ACF Group) ───────────────────────────────────────────
    // Een ACF Group groepeert velden visueel in de editor maar geeft ze elk
    // een eigen sleutel. Je haalt sub-velden van een group op met get_field()
    // zoals elk ander veld — GEEN have_rows() nodig.

    $budget        = get_field( 'budget' );         // number → int / float
    $deadline      = get_field( 'deadline' );        // date_picker → string 'Ymd' of eigen format
    $opdrachtgever = get_field( 'opdrachtgever' );   // post_object → WP_Post object
    ?>

    <?php if ( $budget || $deadline || $opdrachtgever ) : ?>
    <section class="project-meta">
        <h2>Projectinformatie</h2>
        <dl class="meta-lijst">

            <?php if ( $budget ) : ?>
            <dt>Budget</dt>
            <dd>
                <?php
                // number_format() maakt van 150000 → "€ 150.000"
                // esc_html() voorkomt dat kwaadaardige tekst als HTML wordt geïnterpreteerd.
                // Gebruik esc_html() altijd voor waarden die je als tekst weergeeft.
                echo '&euro; ' . esc_html( number_format( (float) $budget, 0, ',', '.' ) );
                ?>
            </dd>
            <?php endif; ?>

            <?php if ( $deadline ) : ?>
            <dt>Deadline</dt>
            <dd>
                <?php
                // ACF date_picker slaat standaard op als 'Ymd' (bijv. 20261231).
                // DateTime::createFromFormat zet dit om naar een leesbare datum.
                $datum_obj = DateTime::createFromFormat( 'Ymd', $deadline );
                if ( $datum_obj ) {
                    echo esc_html( $datum_obj->format( 'd F Y' ) );
                }
                ?>
            </dd>
            <?php endif; ?>

            <?php if ( $opdrachtgever ) : ?>
            <dt>Opdrachtgever</dt>
            <dd>
                <?php
                // post_object geeft een WP_Post object terug.
                // $opdrachtgever->post_title is de paginatitel van de klant.
                // get_permalink() haalt de URL op van dat post-object.
                // esc_url() schoont URL's zodat javascript:-adressen e.d. worden geblokkeerd.
                ?>
                <a href="<?php echo esc_url( get_permalink( $opdrachtgever->ID ) ); ?>">
                    <?php echo esc_html( $opdrachtgever->post_title ); ?>
                </a>
            </dd>
            <?php endif; ?>

        </dl>
    </section>
    <?php endif; ?>


    <?php
    // ─────────────────────────────────────────────────────────────────────────
    // have_rows( $field_name ) + the_row() + get_sub_field( $sub_field_name )
    //
    // have_rows()     — controleert of het repeater-veld rijen bevat én loopt
    //                   intern één rij verder bij elke aanroep (net als
    //                   have_posts() in de WordPress loop). Geeft true/false.
    //
    // the_row()       — zet de interne aanwijzer van ACF naar de volgende rij.
    //                   Verplicht aan het begin van de while-lus.
    //
    // get_sub_field() — haalt de waarde op van een sub-veld binnen de
    //                   ACTIEVE rij. Werkt ALLEEN binnen een have_rows()-lus.
    //                   Buiten de lus weet ACF niet welke rij je bedoelt →
    //                   geeft altijd false terug.
    //
    // Patroon (identiek aan de WordPress post-loop):
    //
    //   if ( have_rows('mijn_repeater') ) :
    //       while ( have_rows('mijn_repeater') ) : the_row();
    //           $waarde = get_sub_field('sub_veld_naam');
    //       endwhile;
    //   endif;
    // ─────────────────────────────────────────────────────────────────────────

    // ── Repeater: Projectfasen ─────────────────────────────────────────────
    // Mapping van de status-waarden (ACF select) naar leesbare labels.
    // De ACF 'value' (machine name) is de sleutel; de weergavenaam de waarde.
    $status_labels = array(
        'gepland'   => 'Gepland',
        'bezig'     => 'Bezig',
        'afgerond'  => 'Afgerond',
    );
    ?>

    <?php if ( have_rows( 'projectfasen' ) ) : ?>
    <section class="projectfasen">
        <h2>Projectfasen</h2>
        <ol class="fasen-lijst">

            <?php while ( have_rows( 'projectfasen' ) ) : the_row(); ?>

                <?php
                // get_sub_field() werkt hier omdat we BINNEN de have_rows()-lus zitten.
                $fase_naam        = get_sub_field( 'fase_naam' );
                $fase_beschrijving = get_sub_field( 'fase_beschrijving' );

                // ACF select geeft de 'value' terug (bijv. 'bezig'), niet het label.
                $fase_status      = get_sub_field( 'fase_status' );

                // Haal het leesbare label op uit de mapping; fallback naar de raw waarde.
                $status_label     = isset( $status_labels[ $fase_status ] )
                                    ? $status_labels[ $fase_status ]
                                    : $fase_status;
                ?>

                <li class="fase fase--<?php echo esc_attr( $fase_status ); ?>">

                    <?php if ( $fase_naam ) : ?>
                    <h3 class="fase__naam"><?php echo esc_html( $fase_naam ); ?></h3>
                    <?php endif; ?>

                    <?php if ( $fase_beschrijving ) : ?>
                    <p class="fase__beschrijving">
                        <?php
                        // nl2br zet harde enters om naar <br>-tags (handig voor textarea-velden).
                        // wp_kses_post() staat alleen veilige HTML-tags toe (vergelijkbaar met
                        // wat WordPress zelf in de editor toestaat). Gebruik dit ipv echo direct
                        // wanneer je HTML in de output wilt toestaan.
                        echo wp_kses_post( nl2br( $fase_beschrijving ) );
                        ?>
                    </p>
                    <?php endif; ?>

                    <?php if ( $fase_status ) : ?>
                    <span class="fase__status fase__status--<?php echo esc_attr( $fase_status ); ?>">
                        <?php echo esc_html( $status_label ); ?>
                    </span>
                    <?php endif; ?>

                </li>

            <?php endwhile; ?>

        </ol>
    </section>
    <?php endif; ?>


    <?php
    // ── Relationship: Gerelateerde projecten ──────────────────────────────
    // get_field() op een relationship-veld geeft een array van WP_Post objecten.
    // ACF laadt de volledige post-objecten automatisch — je hebt geen aparte
    // get_post() of WP_Query nodig.
    $gerelateerde_projecten = get_field( 'gerelateerde_projecten' );
    ?>

    <?php if ( $gerelateerde_projecten ) : ?>
    <section class="gerelateerde-projecten">
        <h2>Gerelateerde projecten</h2>
        <ul class="projecten-grid">

            <?php foreach ( $gerelateerde_projecten as $gerelateerd_project ) : ?>
                <?php
                // Elk item is een WP_Post object met eigenschappen zoals:
                // ->ID, ->post_title, ->post_excerpt, ->post_status
                $thumbnail_id = get_post_thumbnail_id( $gerelateerd_project->ID );
                $thumb_url    = $thumbnail_id
                                ? wp_get_attachment_image_url( $thumbnail_id, 'medium' )
                                : '';
                ?>
                <li class="project-kaart">
                    <a href="<?php echo esc_url( get_permalink( $gerelateerd_project->ID ) ); ?>">

                        <?php if ( $thumb_url ) : ?>
                        <img src="<?php echo esc_url( $thumb_url ); ?>"
                             alt="<?php echo esc_attr( get_the_title( $gerelateerd_project->ID ) ); ?>">
                        <?php endif; ?>

                        <h3><?php echo esc_html( $gerelateerd_project->post_title ); ?></h3>

                        <?php if ( $gerelateerd_project->post_excerpt ) : ?>
                        <p><?php echo esc_html( $gerelateerd_project->post_excerpt ); ?></p>
                        <?php endif; ?>

                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </section>
    <?php endif; ?>


    <div class="project-content">
        <?php the_content(); ?>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
