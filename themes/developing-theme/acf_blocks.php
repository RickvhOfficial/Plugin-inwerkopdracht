<?php 

/* Register custom gutenberg blocks */
add_action('acf/init', 'anna_init_block_types');
function anna_init_block_types() {
    /* Check if acf_register_block_type function exists. */
    if( function_exists('acf_register_block_type') ) {
      /* Set gutenberg block names */
      $custom_blocks = array(
        'Background-cover-image',
        'Content-card-images',
        'Default-feature-list-centered',
        'Grid-testimonial-cards',
        'Default-blog-card',
        'Email-cta',
        'Visual-image-with-heading',
        'Overlay-cards-with-zoom',
        'Image-with-feature-list',
        'Features-cards-section',
        'Images-with-heading-description',
        'Carousel-slider',
        'Content-section-with-cta',
        'Content-with-maps',
        'Default-contact-form',
        'Cta-with-tabs',
        'Faq-accordion',
        'Content-section-with-image-and-features',
        'Image-cta-button',
        'Blog-card-with-image',
        'Contact-form-with-location'
      );
      /* Create gutenberg blocks args */
      foreach ($custom_blocks as $block_key => $title) {
        $slug = sanitize_title($title);
        
        // Controleer eerst of er een submap bestaat met een render template
        // Dit maakt het mogelijk om automatisch submappen te gebruiken
        $subdir_slug_template = 'resources/blocks/' . $slug . '/' . $slug . '.php';
        $subdir_same_name_template = 'resources/blocks/' . $slug . '/' . $slug . '.php';
        $subdir_background_image_template = 'resources/blocks/' . $slug . '/background-cover-image.php';
        $default_template = 'resources/blocks/' . $slug . '.php';
        
        // Controleer verschillende mogelijke template paden (in volgorde van prioriteit)
        $render_template = $default_template;  // standaard fallback
        
        // Voor background-cover-image, zoek het specifieke template eerst
        if ($slug === 'background-cover-image' && file_exists(get_template_directory() . '/' . $subdir_background_image_template)) {
            $render_template = $subdir_background_image_template;
        }
        // Controleer anders op template met slug in een submap 
        elseif (file_exists(get_template_directory() . '/' . $subdir_slug_template)) {
            $render_template = $subdir_slug_template;
        }
        
        $args = array(
            'name'              => sanitize_title($slug),
            'title'             => $title,
            'description'       => $title.' LP Block',
            'mode' => 'edit',
            'render_template'   => $render_template,
            'category'          => 'theme-blocks',
            'icon'              => 'block-default',
            'keywords'          => array($slug, $title)
        );
        // Enqueue gutenberg block style (backend & fronted)
        /*$css_file_helper = str_replace('/app/_acf_blocks.php', '', __FILE__).'/public';

        if(file_exists($css_file_helper.'/blocks/css/'.$slug.'.css')){
          $args['enqueue_style'] = LP_PUBLIC.'/blocks/css/'.$slug.'.css';
        }
        // Enqueue gutenberg block javascript (backend & fronted)
        if(file_exists($css_file_helper.'/blocks/js/'.$slug.'.js')){
          $args['enqueue_script'] = LP_PUBLIC.'/blocks/js/'.$slug.'.js';
        }*/
        //Register gutenberg blocks
        acf_register_block_type($args);
      }
    }
}