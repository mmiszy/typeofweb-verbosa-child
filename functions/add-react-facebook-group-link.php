<?php

function typeofweb_add_react_facebook_group_link() {
    if (is_tax('series', 'react-js') || has_term('react-js', 'series')) {
      ?>
<aside class="content-widget" itemscope="" itemtype="http://schema.org/WPSideBar">
  <section id="custom_html-custom" class="widget_text widget-container widget_custom_html" style="margin: 0;">
    <div class="textwidget custom-html-widget">
      <p style="font-size: 1.8em; text-indent: 0; text-align: center; margin: 0;"> Koniecznie zajrzyj też na grupę:<br> 
        <strong>
          <a href="https://www.facebook.com/groups/1491641220944430/" target="_blank">Uczymy się React z Type of Web na Facebooku</a>
        </strong>
      </p>
    </div>
  </section>
</aside>
      <?php
    }
}

add_action('cryout_before_content_hook', 'typeofweb_add_react_facebook_group_link');
