<?php

function typeofweb_add_custom_head_authors() {
  if (!is_single()) {
    return;
  }

  $multiple_authors = get_post_custom_values('article_author');

  if (empty($multiple_authors)) {
    return;
  }

  foreach ($multiple_authors as $idx => $author ) {
    echo '<meta property="article:author" content="' . esc_attr($author) . '" />';
  }
}
add_action('wp_head', 'typeofweb_add_custom_head_authors', 2);
