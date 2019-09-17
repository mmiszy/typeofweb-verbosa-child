<?php

function typeofweb_add_react_facebook_group_link() {
  $series = NULL;
  if (is_single()) {
    global $post;
    $series = get_the_terms($post->ID, 'series')[0]->name;
  } else if (is_tax('series')) {
    $term = get_term_by('slug', get_query_var( 'term' ), get_query_var('taxonomy')); 
    $series = $term->name;
  }

  if ($series && $series === 'Piece of cake') {
    $series = NULL;
  }
?>

<aside class="content-widget content-widget-before" itemscope="" itemtype="http://schema.org/WPSideBar">
  <section id="text-6" class="widget-container widget_text">
    <div class="textwidget">
      <p style="font-size: 1.8em; text-indent: 0; text-align: center; margin: 0;">
        <?php
          if (is_front_page()) {
            echo '<a style="font-weight: 900" href="https://typeofweb.com/szkolenia?utm_source=https%3A%2F%2Ftypeofweb.com%2F&utm_medium=front_page" target="_blank">Sprawdź szkolenia z Type of Web!</a>';
          } else if ($series) {
            echo do_shortcode('[typeofweb-courses-slogan category="' . $series . '"]');
          } else {
            echo do_shortcode('[typeofweb-courses-slogan]');
          }
        ?>
      </p>
    </div>
  </section>
</aside>

<aside class="content-widget" itemscope="" itemtype="http://schema.org/WPSideBar">
  <section id="custom_html-custom" class="widget_text widget-container widget_custom_html" style="margin: 0;">
    <div class="textwidget custom-html-widget">
      <p style="font-size: 1.8em; text-indent: 0; text-align: center; margin: 0;">Dołącz do rozmów na Discordzie:<br> 
        <strong>
          <a href="https://discord.typeofweb.com" target="_blank">Polski front-end i back-end</a>
        </strong>
      </p>
    </div>
  </section>
</aside>
      <?php
    // }
}

add_action('cryout_before_content_hook', 'typeofweb_add_react_facebook_group_link');
