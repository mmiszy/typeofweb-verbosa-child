<?php

function typeofweb_add_react_facebook_group_link() {
    // if (is_tax('series', 'react-js') || has_term('react-js', 'series')) {
      ?>

<aside class="content-widget content-widget-before" itemscope="" itemtype="http://schema.org/WPSideBar">
  <section id="text-6" class="widget-container widget_text">
    <div class="textwidget">
      <p style="font-size: 1.8em; text-indent: 0; text-align: center; margin: 0;">
        <?php echo do_shortcode('[typeofweb-courses-slogan]'); ?>
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
