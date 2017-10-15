<?php

function typeofweb_remove_wp_version() {
    return '';
}
add_filter('the_generator', 'typeofweb_remove_wp_version', 10, 2);

remove_action('wp_head', 'wp_generator');
