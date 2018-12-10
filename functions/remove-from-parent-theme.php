<?php

function typeofweb_remove_parent_theme_copyright() {
    $removed = remove_action('cryout_master_footer_hook', 'verbosa_master_footer');

    if ($removed) {
        add_action('cryout_master_footer_hook', 'typeofweb_master_footer');
    }
}

function typeofweb_remove_parent_theme_header_image() {
    if (is_single()) {
        remove_action('cryout_headerimage_hook', 'verbosa_header_image', 99);
    }
}

function typeofweb_remove_parent_theme_fonts() {
    remove_action('wp_head', 'verbosa_enqueue_styles', 5 );
    remove_action( 'wp_enqueue_scripts', 'tp_twitter_plugin_styles' );
}

function typeofweb_remove_parent_theme_featured_images() {
    $removed1 = remove_action( 'cryout_featured_hook', 'verbosa_set_featured_thumb' );
    $removed2 = remove_action( 'cryout_singlefeatured_hook', 'verbosa_set_featured_thumb' );

    if ($removed1 && $removed2) {
        add_action( 'cryout_featured_hook', 'typeofweb_featured_image' );
        add_action( 'cryout_singlefeatured_hook', 'typeofweb_featured_image' );
    }
}

add_action('wp', 'typeofweb_remove_parent_stuff', 0);
function typeofweb_remove_parent_stuff() {
    typeofweb_remove_parent_theme_copyright();
    typeofweb_remove_parent_theme_header_image();
    typeofweb_remove_parent_theme_fonts();
    typeofweb_remove_parent_theme_featured_images();
    typeofweb_remove_parent_theme_responsive_meta();
}

function typeofweb_remove_parent_theme_responsive_meta() {
    $removed = remove_action('cryout_meta_hook', 'verbosa_responsive_meta');
    
    if ($removed) {
        add_action('cryout_meta_hook', 'typeofweb_responsive_meta');
    }
}

function typeofweb_responsive_meta() {
	echo '<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, viewport-fit=cover">' . PHP_EOL;	
}

function typeofweb_master_footer() {
    $typeofweb_theme = wp_get_theme();
    $verbosa_theme = $typeofweb_theme->parent();

	do_action('cryout_footer_hook');
	echo '<div id="site-copyright">' . wp_kses_post(cryout_get_option('verbosa_copyright')) . '</div>' .
	    '<div id="poweredby">' . __("Powered by","verbosa") .
        ' <a target="_blank" href="' . esc_url($verbosa_theme->get('ThemeURI'))  . '" title="Verbosa Theme by Cryout Creations">Verbosa</a>' .
        ' modified by ' .
        '<a href="' . esc_url($typeofweb_theme->get('ThemeURI'))  . '" title="Type of Web"> Type of Web </a>' .
    '</div>';
}

function typeofweb_featured_image() {
	global $post;
    $verbosas = cryout_get_option( array('verbosa_fpost', 'verbosa_fauto', 'verbosa_falign') );
    $attachment_id = 0;
    $is_new = $post->ID >= 1734;

	if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $verbosas['verbosa_fpost']) {
        // has featured image
        $attachment_id = get_post_thumbnail_id( $post->ID );

        if ($is_new) {
            $featured_image = wp_get_attachment_image_src( $attachment_id, 'post-thumbnail' );
        } else {
            $featured_image = wp_get_attachment_image_src( $attachment_id, 'verbosa-featured' );
        }        
    }
    // elseif ( $verbosas['verbosa_fpost'] && $verbosas['verbosa_fauto'] && empty( $featured_image ) ) {
	// 	// get the first image from post
	// 	$featured_image = cryout_post_first_image( $post->ID, 'verbosa-featured' );
    //     $attachment_id = $featured_image['id'];
    // }
    else {
		// featured image not enabled or not obtainable
		$featured_image = '';
	};

	if ( ! empty( $featured_image[0] ) ):
		$featured_image_url = esc_url( $featured_image[0] );
		$featured_image_w = $featured_image[1];
        $featured_image_h = $featured_image[2];
        $ratio = $featured_image_h / $featured_image_w * 100;
        
        $img_str = '<img width="' . $featured_image_w . '" height="' . $featured_image_h . '" class="post-featured-image wp-image-' . $attachment_id . '" alt="' . the_title_attribute('echo=0') . '" ' . cryout_schema_microdata( 'url', 0 ) . ' src="' . $featured_image_url . '" />';

        ?>
<div class="post-thumbnail-container <?php echo $is_new ? 'is-new' : '' ?>" <?php cryout_schema_microdata( 'image' ); ?>>
    <a class="responsive-featured-image"
        href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>"
        title="<?php echo esc_attr( get_post_field( 'post_title', $post->ID ) ) ?>"
        >
        <?php echo apply_filters( 'bj_lazy_load_html', $img_str ); ?>
    </a>

    <meta itemprop="width" content="<?php echo $featured_image_w; ?>">
    <meta itemprop="height" content="<?php echo $featured_image_h; ?>">
</div>
    <?php
        endif;
    ?>

<div class="featured-bar"></div>

    <?php
}
