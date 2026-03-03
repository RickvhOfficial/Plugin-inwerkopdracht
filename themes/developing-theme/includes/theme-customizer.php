<?php
/**
 * Theme Customizer
 * 
 * Voegt aanpassingen toe aan de WordPress Customizer voor thema-instellingen
 */

function theme_customize_register($wp_customize) {
    $wp_customize->add_section('contact_info', array(
        'title' => __('Contact Informatie', 'jouw-theme-naam'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('contact_email');
    $wp_customize->add_control('contact_email', array(
        'label' => __('Email Adres', 'jouw-theme-naam'),
        'section' => 'contact_info',
        'type' => 'text',
    ));

    $wp_customize->add_setting('contact_phone');
    $wp_customize->add_control('contact_phone', array(
        'label' => __('Telefoonnummer', 'jouw-theme-naam'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
}
add_action('customize_register', 'theme_customize_register'); 