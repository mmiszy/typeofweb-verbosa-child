<?php

function typeofweb_add_facebook_page_shortcode( $atts ) {
	$atts = shortcode_atts(array(
		'width' => '304',
        'small-header' => 'true',
        'adapt-container-width' => 'true',
        'hide-cover' => 'false',
        'show-facepile' => 'true',
        'tabs' => ''
	), $atts, 'typeofweb-facebook-page');

    return '
<div class="fb-page" data-href="https://www.facebook.com/typeofweb"
    data-width="' . esc_attr($atts['width']) . '"
    data-small-header="' . esc_attr($atts['small-header']) . '"
    data-adapt-container-width="' . esc_attr($atts['adapt-container-width']) . '"
    data-hide-cover="' . esc_attr($atts['hide-cover']) . '"
    data-show-facepile="' . esc_attr($atts['show-facepile']) . '"
    data-tabs="' . esc_attr($atts['tabs']) . '"
    >
    <blockquote cite="https://www.facebook.com/typeofweb" class="fb-xfbml-parse-ignore">
        <a href="https://www.facebook.com/typeofweb">Type of Web</a>
    </blockquote>
</div>
    ';
}
add_shortcode( 'typeofweb-facebook-page', 'typeofweb_add_facebook_page_shortcode' );
