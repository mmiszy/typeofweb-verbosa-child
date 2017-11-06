<?php

function typeofweb_enqueue_styles() {
    wp_enqueue_style('verbosa-main', get_template_directory_uri() .'/style.css');

    wp_enqueue_style('verbosa-themefonts', get_template_directory_uri() . '/resources/fonts/fontfaces.css', null, _CRYOUT_THEME_VERSION);
    wp_add_inline_style('verbosa-main', preg_replace("/[\n\r\t\s]+/"," " ,verbosa_custom_styles()));

    // wp_enqueue_style( 'inlined-fonts', get_stylesheet_directory_uri() . '/inlined-fonts.css' );


	wp_enqueue_style('verbosa-child', get_stylesheet_directory_uri() .'/style.css', array('verbosa-main'));	

    wp_enqueue_script( 'prism', get_stylesheet_directory_uri() . '/prism.js' , null, null, true );
    wp_enqueue_style( 'prism', get_stylesheet_directory_uri() . '/prism.css' );

    wp_enqueue_script( 'share-buttons', get_stylesheet_directory_uri() . '/share-buttons.js' , array('jquery'), null, true );
    wp_enqueue_script( 'fix-mobile-menu', get_stylesheet_directory_uri() . '/fix-mobile-menu.js' , array('jquery'), null, true );

    // wp_enqueue_script( 'track-outbound-links', get_stylesheet_directory_uri() . '/track-outbound-links.js' , array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'typeofweb_enqueue_styles' );
