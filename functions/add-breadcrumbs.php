<?php

function typeofweb_breadcrumbs() {
    if (!is_single()) {
        return;
    }
    
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    }
}

function typeofweb_meta_breadcrumbs() {
    add_action( 'cryout_post_meta_hook', 'typeofweb_breadcrumbs', 8);
}
add_action('wp_head','typeofweb_meta_breadcrumbs');
