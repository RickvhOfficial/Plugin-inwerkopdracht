<?php
/**
 * Visual Image with Heading Template
 * 
 * Hoofdtemplate bestand voor het Visual Image with Heading blok.
 */
$heading = get_field('viwh_heading') ?: '';
$description = get_field('viwh_description') ?: '';
$image = get_field('viwh_image');
$primary_button = get_field('viwh_primary_button');
$secondary_button = get_field('viwh_secondary_button');

// Als er geen content is, toon niks
if (empty($heading) && empty($description) && empty($image)) {
    return;
}
?>

<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <?php if (!empty($heading)): ?>
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white"><?php echo esc_html($heading); ?></h1>
            <?php endif; ?>
            
            <?php if (!empty($description)): ?>
            <div class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400"><?php echo $description; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($primary_button['text']) && !empty($primary_button['url'])): ?>
            <a href="<?php echo esc_url($primary_button['url']); ?>" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                <?php echo esc_html($primary_button['text']); ?>
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
            <?php endif; ?>
            
            <?php if (!empty($secondary_button['text']) && !empty($secondary_button['url'])): ?>
            <a href="<?php echo esc_url($secondary_button['url']); ?>" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                <?php echo esc_html($secondary_button['text']); ?>
            </a>
            <?php endif; ?>
        </div>
        <div class="lg:mt-0 lg:col-span-5 lg:flex lg:items-start">
            <?php if (!empty($image)): ?>
            <img class="w-full h-auto object-contain" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <?php endif; ?>
        </div>                
    </div>
</section>