<?php
/**
 * Block Template: FAQ Accordion
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value
$id = 'faq-accordion-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values
$className = 'faq-accordion';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults
$section_background = get_field('section_background') ?: 'white';
$heading = get_field('heading') ?: 'Veel gestelde vragen';
$introduction = get_field('introduction');
$faq_items = get_field('faq_items') ?: [];

// Background class
$bg_class = 'bg-white dark:bg-gray-900';
if ($section_background === 'gray') {
    $bg_class = 'bg-gray-100 dark:bg-gray-800';
} elseif ($section_background === 'dark') {
    $bg_class = 'bg-gray-900 dark:bg-gray-900 text-white';
}

// Preview-specific settings
if (!empty($block['data']['is_preview'])) {
    echo '<img src="' . esc_url(get_template_directory_uri()) . '/resources/blocks/faq-accordion/preview.jpg" alt="Preview" style="width:100%; height:auto;">';
    return;
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php echo esc_attr($bg_class); ?>">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <h2 class="mb-6 lg:mb-8 text-3xl lg:text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white"><?php echo esc_html($heading); ?></h2>
        
        <?php if (!empty($introduction)): ?>
        <div class="mx-auto max-w-screen-md mb-8 text-center">
            <p class="text-gray-500 dark:text-gray-400"><?php echo esc_html($introduction); ?></p>
        </div>
        <?php endif; ?>
        
        <div class="mx-auto max-w-screen-md">
            <?php if (!empty($faq_items)): ?>
            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-primary-600 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                <?php foreach ($faq_items as $index => $item): ?>
                <h2 id="accordion-flush-heading-<?php echo $index + 1; ?>">
                    <button type="button" class="flex justify-between items-center py-5 w-full font-medium text-left <?php echo ($index === 0) ? 'text-primary-600 bg-white dark:text-white' : 'text-gray-500 dark:text-gray-400'; ?> border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900" data-accordion-target="#accordion-flush-body-<?php echo $index + 1; ?>" aria-expanded="<?php echo ($index === 0) ? 'true' : 'false'; ?>" aria-controls="accordion-flush-body-<?php echo $index + 1; ?>">
                        <span><?php echo esc_html($item['question']); ?></span>
                        <svg data-accordion-icon="" class="w-6 h-6 <?php echo ($index === 0) ? 'rotate-180' : ''; ?> shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-<?php echo $index + 1; ?>" class="<?php echo ($index === 0) ? '' : 'hidden'; ?>" aria-labelledby="accordion-flush-heading-<?php echo $index + 1; ?>">
                    <div class="py-5 border-b border-gray-200 dark:border-gray-700 text-gray-500">
                        <?php echo wp_kses_post($item['answer']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="text-center py-8">
                <p class="text-gray-500 dark:text-gray-400">Voeg FAQ items toe in de editor.</p>
            </div>
            <?php endif; ?>
        </div>               
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordionItems = document.querySelectorAll('[data-accordion-target]');
    
    accordionItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetId = this.getAttribute('data-accordion-target');
            const targetElement = document.querySelector(targetId);
            const expanded = this.getAttribute('aria-expanded') === 'true';
            
            // Close all accordion items
            accordionItems.forEach(accItem => {
                const accTargetId = accItem.getAttribute('data-accordion-target');
                const accTargetElement = document.querySelector(accTargetId);
                const accExpanded = accItem.getAttribute('aria-expanded') === 'true';
                
                if (accExpanded && accItem !== this) {
                    accItem.setAttribute('aria-expanded', 'false');
                    accItem.classList.remove('text-primary-600', 'bg-white', 'dark:text-white');
                    accItem.classList.add('text-gray-500', 'dark:text-gray-400');
                    accItem.querySelector('svg').classList.remove('rotate-180');
                    accTargetElement.classList.add('hidden');
                }
            });
            
            // Toggle current accordion item
            this.setAttribute('aria-expanded', !expanded);
            if (!expanded) {
                this.classList.remove('text-gray-500', 'dark:text-gray-400');
                this.classList.add('text-primary-600', 'bg-white', 'dark:text-white');
                this.querySelector('svg').classList.add('rotate-180');
                targetElement.classList.remove('hidden');
            } else {
                this.classList.remove('text-primary-600', 'bg-white', 'dark:text-white');
                this.classList.add('text-gray-500', 'dark:text-gray-400');
                this.querySelector('svg').classList.remove('rotate-180');
                targetElement.classList.add('hidden');
            }
        });
    });
});
</script>