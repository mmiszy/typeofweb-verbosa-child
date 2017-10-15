<?php

function typeofweb_display_mailchimp() {
    ?>
<!-- Begin MailChimp Signup Form -->
<!-- <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css"> -->
<div id="mc_embed_signup">
<form action="//typeofweb.us16.list-manage.com/subscribe/post?u=8073e459fa97c5444592f393a&amp;id=9c6a75a636" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
    <div id="mc_embed_signup_scroll">
        <label for="mce-EMAIL">Podoba się? Nie przegap kolejnych artykułów!</label>
        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Podaj adres email" required oninvalid="this.setCustomValidity('Wprowadź adres email')" oninput="setCustomValidity(''); checkValidity();">
        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8073e459fa97c5444592f393a_9c6a75a636" tabindex="-1" value=""></div>
        <div class="clear"><input type="submit" value="Zapisz się" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>
<!--End mc_embed_signup-->
    <?php
}
add_action('cryout_post_footer_hook', 'typeofweb_display_mailchimp', 20);

add_action('cryout_after_article_hook', function () {
    if (!is_home()) {
        return;
    }

    global $wp_query;

    if ($wp_query->current_post === 0) {
        echo '<div class="pad-container inner-post-mailchimp-container"><div class="featured-bar"></div>';
        typeofweb_display_mailchimp();
        echo '</div>';
    }
});
