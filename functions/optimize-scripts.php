<?php

function add_defer_attribute($tag, $handle) {
    $scripts_to_defer = array('Hyphenator', 'Hyphenator-pl', 'Hyphenator-config', 'prism');
    
    if (in_array($handle, $scripts_to_defer, true)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
 }
 add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

function add_async_attribute($tag, $handle) {
    $scripts_to_async = array('ssba-sharethis');

    if (in_array($handle, $scripts_to_async, true)) {
        return str_replace(' src', ' async src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
