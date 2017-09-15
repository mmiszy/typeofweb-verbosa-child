<?php

function add_to_series_title($title) {
    return 'Kurs ' . $title;
}

function modify_archive_title( $title ) {
    if (is_tax('series')) {
        $title = single_term_title( '', false );
        return add_to_series_title($title);
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'modify_archive_title', 10, 1 );

function modify_series_title($title) {
    if (is_tax('series')) {
        return add_to_series_title($title);
    }
    return $title;
}
add_filter('list_cats', 'modify_series_title', 10, 1);

add_action('template_redirect', function () {
    global $orgseries;
    if (!is_single()) {
        remove_filter('the_content', array($orgseries, 'add_series_meta'), 12);
    }
});
