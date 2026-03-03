<?php
/**
 * Content Section with CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'content-section-with-cta-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Load values and handle defaults.
$section_background = get_field('section_background') ?: 'white';
$left_section_title = get_field('left_section_title') ?: 'Overview';
$left_section_content = get_field('left_section_content') ?: 'Since 1984, Flowbite has been serving up grab-and-go frozen daiquiris from its stores across the U.S. Its signature drinks, souvenir cups, and discounted refills have made Flowbite synonymous with great music, good vibes, and starting the best party in town.';
$features = get_field('features');

$right_sections = get_field('right_sections');

$cta_enabled = get_field('cta_enabled');
$cta_text = get_field('cta_text');
$cta_url = get_field('cta_url');
$cta_style = get_field('cta_style') ?: 'primary';

// Bepaal de achtergrondklasse op basis van de selectie
$bg_class = '';
switch ($section_background) {
    case 'gray':
        $bg_class = 'bg-gray-50 dark:bg-gray-800';
        break;
    case 'dark':
        $bg_class = 'bg-gray-900 text-white';
        break;
    default: // white
        $bg_class = 'bg-white dark:bg-gray-900';
        break;
}

// Bepaal de CTA stijl
$cta_class = '';
switch ($cta_style) {
    case 'outline':
        $cta_class = 'text-primary-600 bg-white border border-primary-600 hover:bg-primary-700 hover:text-white focus:ring-4 focus:ring-primary-300 dark:bg-gray-800 dark:border-primary-500 dark:text-primary-500 dark:hover:text-white dark:hover:bg-primary-600 dark:focus:ring-primary-800';
        break;
    case 'secondary':
        $cta_class = 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800';
        break;
    default: // primary
        $cta_class = 'text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800';
        break;
}

    // Fallback features voor preview
    if ($is_preview && (!is_array($features) || count($features) === 0)) {
        $features = [
            ['feature_text' => 'A/B Testing'],
            ['feature_text' => 'Craft CMS development'],
            ['feature_text' => 'UX/UI design'],
            ['feature_text' => 'Copywriting'],
            ['feature_text' => 'Brand development'],
            ['feature_text' => 'Graphic design'],
            ['feature_text' => 'Front-end development'],
            ['feature_text' => 'SEO'],
        ];
    }

    // Fallback right sections for preview
    if ($is_preview && (!is_array($right_sections) || count($right_sections) === 0)) {
        $right_sections = [
            [
                'section_title' => 'Background',
                'section_content' => "Come 2021, Flowbite had expanded to over 40 locations. The brand's digital presence existed, but it lacked strategy. Although its target market of 21-30 year-olds was as engaged (and as loyal) as ever, the brand had outgrown its amateur look of the early '00s and the family-owned business vibes. It needed to show it was a strong brand moving in a new direction - and it was heading there fast."
            ],
            [
                'section_title' => 'The challenge',
                'section_content' => "Flowbite's new website would set the tone for all future marketing initiatives, so the brand needed something to showcase its new identity as soon as possible. A tight timeline, paired with the fact that the new management team were still exploring how to shift the brand from what it used to be to what it needed to be, meant that working collaboratively was a must."
            ]
        ];
      }
// Fallback features
if (!is_array($features) || count($features) === 0) {
    $features = [
        ['feature_text' => 'A/B Testing'],
        ['feature_text' => 'Craft CMS development'],
        ['feature_text' => 'UX/UI design'],
        ['feature_text' => 'Copywriting'],
        ['feature_text' => 'Brand development'],
        ['feature_text' => 'Graphic design'],
        ['feature_text' => 'Front-end development'],
        ['feature_text' => 'SEO'],
    ];
}

// Fallback right sections
if (!is_array($right_sections) || count($right_sections) === 0) {
    $right_sections = [
        [
            'section_title' => 'Background',
            'section_content' => "Come 2021, Flowbite had expanded to over 40 locations. The brand's digital presence existed, but it lacked strategy. Although its target market of 21-30 year-olds was as engaged (and as loyal) as ever, the brand had outgrown its amateur look of the early '00s and the family-owned business vibes. It needed to show it was a strong brand moving in a new direction - and it was heading there fast."
        ],
        [
            'section_title' => 'The challenge',
            'section_content' => "Flowbite's new website would set the tone for all future marketing initiatives, so the brand needed something to showcase its new identity as soon as possible. A tight timeline, paired with the fact that the new management team were still exploring how to shift the brand from what it used to be to what it needed to be, meant that working collaboratively was a must."
        ]
    ];
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($bg_class); ?>">
  <div class="max-w-screen-xl px-4 py-8 mx-auto lg:px-6 sm:py-16 lg:py-24">
    <div class="grid grid-cols-1 gap-8 mt-8 lg:gap-16 lg:grid-cols-2 lg:mt-16">
      <div>
        <div>
          <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">
            <?php echo esc_html($left_section_title); ?>
          </h3>
          <div class="mt-2 text-lg font-light text-gray-500 dark:text-gray-400">
            <?php echo wp_kses_post($left_section_content); ?>
          </div>
        </div>

        <?php if (is_array($features) && count($features) > 0) : ?>
        <ul class="grid grid-cols-1 mt-8 sm:grid-cols-2 gap-x-4 gap-y-3">
          <?php foreach ($features as $feature) : ?>
          <li class="flex items-center gap-2.5">
            <svg class="w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
            </svg>
            <span class="text-base font-light text-gray-500 dark:text-gray-400">
              <?php echo esc_html($feature['feature_text']); ?>
            </span>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <?php if ($cta_enabled && $cta_text && $cta_url) : ?>
        <div class="mt-8">
          <a href="<?php echo esc_url($cta_url); ?>" class="px-5 py-3 text-base font-medium rounded-lg <?php echo esc_attr($cta_class); ?>">
            <?php echo esc_html($cta_text); ?>
          </a>
        </div>
        <?php endif; ?>
      </div>

      <?php if (is_array($right_sections) && count($right_sections) > 0) : ?>
      <div class="space-y-8">
        <?php foreach ($right_sections as $section) : ?>
        <div>
          <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">
            <?php echo esc_html($section['section_title']); ?>
          </h3>
          <div class="mt-2 text-lg font-light text-gray-500 dark:text-gray-400">
            <?php echo wp_kses_post($section['section_content']); ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>