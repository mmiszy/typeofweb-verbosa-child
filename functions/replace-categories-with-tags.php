<?php

function typeofweb_posted_category() {
    $tag_list = get_the_tag_list( '', ' / ' );
    if ($tag_list) {
        ?>
<div class="entry-meta">
    <span class="bl_categ" <?php cryout_schema_microdata( 'tags' ) ?>>
        <i class="icon-books icon-metas" title="<?php _e( 'Tagged','verbosa') ?>"></i>&nbsp;<?php echo $tag_list ?>
    </span>
</div>
        <?php
    }
}

function typeofweb_meta_infos() {
    add_action( 'cryout_post_meta_hook', 'typeofweb_posted_category', 14);
}
add_action('wp_head','typeofweb_meta_infos');
