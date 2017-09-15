<?php

function typeofweb_show_share_buttons2($content, $booShortCode = FALSE, $atts = '') {
    global $post;

    $shouldAddButtons = is_single() || is_page();

    if (!$shouldAddButtons) {
        return $content;
    }

    $postID = get_the_ID();
    $currentPageUrl = get_permalink($post->ID);
    $pageTitle = get_the_title($post->ID);
    $twitterShareText = urlencode(html_entity_decode($pageTitle, ENT_COMPAT, 'UTF-8'));

    $htmlShareButtons = '
    <div class="share-buttons">
        <div>
            <a data-site="" data-facebook="mobile" class="share-buttons_facebook_share" data-href="' . $currentPageUrl . '" href="https://www.facebook.com/dialog/share?app_id=1709793622637583&amp;display=popup&amp;href=' . $currentPageUrl . '&amp;redirect_uri=' . $currentPageUrl . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/images/facebook.png" title="Facebook" class="share-buttons share-buttons-img" alt="Share on Facebook"></a>
            <a data-site="" class="share-buttons_twitter_share" href="http://twitter.com/share?url=' . $currentPageUrl . '&amp;text= ' . $twitterShareText . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/images/twitter.png" title="Twitter" class="share-buttons share-buttons-img" alt="Tweet about this on Twitter"></a>
            <a data-site="" class="share-buttons_google_share" href="https://plus.google.com/share?url=' . $currentPageUrl . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/images/google.png" title="Google+" class="share-buttons share-buttons-img" alt="Share on Google+"></a>
            <a data-site="linkedin" class="share-buttons_linkedin_share share-buttons_share_link" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $currentPageUrl . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/images/linkedin.png" title="LinkedIn" class="ssba ssba-img" alt="Share on LinkedIn"></a>
        </div>
    </div>
    ';

    return $htmlShareButtons . $content . $htmlShareButtons;
}
add_filter('the_content', 'typeofweb_show_share_buttons2');
