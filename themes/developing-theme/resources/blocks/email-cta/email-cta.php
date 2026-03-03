<?php
/**
 * Email CTA Template
 * 
 * Hoofdtemplate bestand voor het Email CTA blok.
 */
$email_title = get_field('email_title') ?: '';
$email_description = get_field('email_description') ?: '';
$gravity_form_shortcode = get_field('gravity_form_shortcode') ?: '';
$disclaimer_text = get_field('disclaimer_text') ?: '';

// Als er geen content is, toon niks
if (empty($email_title) && empty($email_description) && empty($gravity_form_shortcode)) {
    return;
}
?>

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md text-center">
            <?php if (!empty($email_title)): ?>
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($email_title); ?></h2>
            <?php endif; ?>
            
            <?php if (!empty($email_description)): ?>
            <p class="mb-6 font-light text-gray-500 sm:text-xl dark:text-gray-400"><?php echo esc_html($email_description); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($gravity_form_shortcode)): ?>
            <div class="mx-auto max-w-screen-sm text-left">
                <?php echo do_shortcode($gravity_form_shortcode); ?>
                
                <?php if (!empty($disclaimer_text)): ?>
                <div class="mt-4 text-sm font-light text-left text-gray-500 dark:text-gray-300">
                    <?php echo esc_html($disclaimer_text); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>