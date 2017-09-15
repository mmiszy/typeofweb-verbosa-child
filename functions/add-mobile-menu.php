<?php

function typeofweb_widgets_init() {
    register_sidebar(array(
        'name' 			=> 'Mobile - After Menu',
        'id' 			=> 'typeofweb-widget-area-mobile-menu',
        'description' 	=> 'Visible only on mobile, under menu',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
    ));
}
add_action( 'widgets_init', 'typeofweb_widgets_init' );

function typeofweb_mobile_menu() {
    ?>
<aside class="widget-area sidey" role="complementary" <?php cryout_schema_microdata('sidebar');?>>
    <?php dynamic_sidebar( 'typeofweb-widget-area-mobile-menu' ); ?>
</aside><!--content-widget-->
    <?php
}
add_action( 'cryout_mobilemenu_hook', 'typeofweb_mobile_menu', 20 );
