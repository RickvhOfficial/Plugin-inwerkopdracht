<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="portfolio-single">
    <div class="top-content">
    <h1><?php the_title(); ?></h1>

    <?php
    $klant    = get_field('klant_naam');
    $url      = get_field('project_url');
    $datum    = get_field('opleverdatum');
    $techs    = get_field('technologieen');
    $extra_afbeelding = get_field('uitgelichte_afbeelding_extra');
    $beschrijving = get_field('project_beschrijving');
    
    ?>

    <div class="portfolio-meta">
        <?php if ( $klant ) : ?>
            <p><strong>Klant:</strong> <?php echo esc_html( $klant ); ?></p>
        <?php endif; ?>

        <?php if ( $url ) : ?>
            <p><strong>Website:</strong>
                <a href="<?php echo esc_url( $url ); ?>" target="_blank">
                    <?php echo esc_url( $url ); ?>
                </a>
            </p>
        <?php endif; ?>

        <?php 
        if ( $datum ) : 
        $date_object = DateTime::createFromFormat('Ymd', $datum);
        ?>
            <p><strong>Opgeleverd:</strong> 
            <?php echo esc_html( $date_object->format('d F Y') ); ?>
        </p>
        <?php endif; ?>

        <?php if ( $techs ) : ?>
            <p><strong>Technologieën:</strong> 
                <?php echo esc_html( implode(', ', $techs) ); ?>
                <!-- emplode is voor het omzetten van een array naar een string -->
            </p>
        <?php endif; ?>
    </div>
        </div>
    <?php if (have_rows('team_leden') ) : ?>
        <section class="team">
            <h2>Teamleden</h2>
        <div class="team-grid">
            <?php while ( have_rows('team_leden') ) : the_row(); ?>

                <?php
                $naam = get_sub_field('naam');
                $functie = get_sub_field('functie');
                $foto = get_sub_field('foto');
                ?>

                <div class="team-lid">

                <?php if ( $foto ) : ?>
                    <img src="<?php echo esc_url( $foto['url'] ); ?>"
                         alt="<?php echo esc_attr( $foto['alt'] ); ?>">
                    <?php endif; ?>

                   <?php if ( $naam ) : ?>
                    <h3><?php echo esc_html( $naam ); ?></h3>
                    <?php endif; ?>

                    <?php if ( $functie ) : ?>
                        <p><?php echo esc_html( $functie ); ?></p>
                        <?php endif; ?>

                    </div>
            
                    <?php endwhile; ?>
</div>   
                </section>
            <?php endif; ?>

        <?php endwhile; endif; ?>
        
    <?php if ( $beschrijving ) : ?>
       <div class="project-beschrijving">
        <h2>Project beschrijving:</h2>
          <?php echo esc_html( $beschrijving ); ?>
        </div>
    <?php endif; ?>

        <?php if ( $extra_afbeelding ) : ?>
            <div class="portfolio-extra-image">
                <img src="<?php echo esc_url( $extra_afbeelding['url'] ); ?>"
                alt="<?php echo esc_attr( $extra_afbeelding['alt'] ); ?>">
        </div>
        <?php endif; ?>

    <div class="portfolio-content">
        <?php the_content(); ?>
    </div>
    
</article>

<?php get_footer(); ?>
