<?php
/**
 * Features Cards Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// ACF velden voor het block
$title = get_field('title') ?: 'The most trusted cryptocurrency platform';
$description = get_field('description') ?: 'Here are a few reasons why you should choose Flowbite';

// Features ophalen
$features = get_field('features');
if (empty($features)) {
    // Fallback features als er geen zijn ingesteld
    $features = [
        [
            'title' => 'Secure storage',
            'description' => 'We store the vast majority of the digital assets in secure offline storage.',
            'link_url' => '#',
            'link_text' => 'Learn how to keep your funds safe'
        ],
        [
            'title' => 'Insurance',
            'description' => 'Flowbite maintains crypto insurance and all USD cash balances are covered.',
            'link_url' => '#',
            'link_text' => 'Learn how your crypto is covered'
        ],
        [
            'title' => 'Best practices',
            'description' => 'Flowbite marketplace supports a variety of the most popular digital currencies.',
            'link_url' => '#',
            'link_text' => 'How to implement best practices'
        ]
    ];
}
?>

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-screen-xl text-center sm:py-16 lg:px-6">
      <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo esc_html($title); ?></h2>
      <p class="text-gray-500 sm:text-xl dark:text-gray-400"><?php echo esc_html($description); ?></p>
      <div class="mt-8 lg:mt-12 space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
          <?php foreach ($features as $feature) : ?>
          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
              <?php if (!empty($feature['icon']) && is_array($feature['icon'])) : ?>
                <div class="mx-auto mb-4 flex justify-center">
                    <img src="<?php echo esc_url($feature['icon']['url']); ?>" 
                         alt="<?php echo esc_attr($feature['title']) . ' icoon'; ?>" 
                         class="w-16 h-16 object-contain" />
                </div>
              <?php else : ?>
                <div class="mx-auto mb-4 w-16 h-16 flex items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
                    <svg class="w-10 h-10 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                    </svg>
                </div>
              <?php endif; ?>
              <h3 class="mb-2 text-xl font-bold dark:text-white"><?php echo esc_html($feature['title']); ?></h3>
              <p class="mb-4 text-gray-500 dark:text-gray-400"><?php echo esc_html($feature['description']); ?></p>
              <?php if (!empty($feature['link_url']) && !empty($feature['link_text'])) : ?>
              <a href="<?php echo esc_url($feature['link_url']); ?>" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-primary-500 dark:hover:text-primary-400">
                  <?php echo esc_html($feature['link_text']); ?> <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              </a>
              <?php endif; ?>
          </div>
          <?php endforeach; ?>
      </div>
  </div>
</section>
