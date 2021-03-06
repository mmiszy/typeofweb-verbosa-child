<?php

require_once(__DIR__ . '/functions/security.php');
require_once(__DIR__ . '/functions/add-service-worker.php');
require_once(__DIR__ . '/functions/language.php');
require_once(__DIR__ . '/functions/optimize-scripts.php');
require_once(__DIR__ . '/functions/add-styles-scripts.php');
// require_once(__DIR__ . '/functions/replace-categories-with-tags.php'); // disabled
require_once(__DIR__ . '/functions/modify-series.php');
require_once(__DIR__ . '/functions/add-share-buttons.php');
require_once(__DIR__ . '/functions/add-social.php');
// require_once(__DIR__ . '/functions/add-google-fonts.php');
require_once(__DIR__ . '/functions/add-facebook-page-shortcode.php');
require_once(__DIR__ . '/functions/add-jobs-shortcode.php');
require_once(__DIR__ . '/functions/add-mailchimp-widget.php');
require_once(__DIR__ . '/functions/add-verification-meta.php');
require_once(__DIR__ . '/functions/remove-from-parent-theme.php');
require_once(__DIR__ . '/functions/add-breadcrumbs.php');
require_once(__DIR__ . '/functions/add-reading-progress.php');
// require_once(__DIR__ . '/functions/add-react-facebook-group-link.php');
require_once(__DIR__ . '/functions/add-discord-link.php');
require_once(__DIR__ . '/functions/add-custom-head-tags.php');
require_once(__DIR__ . '/functions/add-courses-shortcode.php');


function async_scripts() {
    return 'defer ';
}
add_filter('autoptimize_filter_js_defer', 'async_scripts');

function typeofweb_change_author_base() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'autor';
}
add_action('init','typeofweb_change_author_base');
