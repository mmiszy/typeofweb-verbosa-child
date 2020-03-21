<?php

function typeofweb_display_mailchimp() {
    echo do_shortcode('[typeofweb-mailchimp]');
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

function typeofweb_add_mailchimp_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Podoba się? Nie przegap kolejnych artykułów!',
    ), $atts, 'typeofweb-mailchimp');

    return '
    <!-- Begin MailChimp Signup Form -->
    <div id="mc_embed_signup">
    <form action="https://typeofweb.us16.list-manage.com/subscribe/post?u=8073e459fa97c5444592f393a&amp;id=9c6a75a636" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
        <div id="mc_embed_signup_scroll">
            <div class="mc-field-group">
                <label for="mce-EMAIL">' . esc_html($atts['title']) . '</label>
                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Podaj adres email" required oninvalid="this.setCustomValidity(\'Wprowadź adres email\')" oninput="setCustomValidity(\'\'); checkValidity();">
            </div>
            <div id="mergeRow-gdpr" class="mergeRow gdpr-mergeRow content__gdprBlock mc-field-group">
                <div class="content__gdpr">
                    <fieldset class="mc_fieldset gdprRequired mc-field-group" name="interestgroup_field">
                        <label class="checkbox subfield" for="gdpr_27543">
                            <input type="checkbox" id="gdpr_27543" name="gdpr[27543]" value="Y" class="av-checkbox gdpr" required oninvalid="this.setCustomValidity(\'RODO wymaga, żeby to było zaznaczone.\')" onchange="setCustomValidity(\'\'); checkValidity();">
                            <span>Rozumiem i akceptuję Regulamin Newslettera oraz Politykę Prywatności. Wyrażam zgodę na otrzymywanie na podany adres e-mail informacji handlowych w rozumieniu ustawy z&nbsp;dnia 18 lipca 2002&nbsp;r. o&nbsp;świadczeniu usług drogą elektroniczną.</span>
                        </label>
                    </fieldset>
                    <p class="no-spam-promise">Nie wysyłamy spamu, tylko wartościowe informacje. W&nbsp;każdej chwili możesz się wypisać klikajac „unsubscribe” w stopce maila.</p>
                </div>
            </div>
            
            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8073e459fa97c5444592f393a_9c6a75a636" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Zapisz się" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </div>
    </form>
    </div>
    <!--End mc_embed_signup-->
        ';
}

add_shortcode( 'typeofweb-mailchimp', 'typeofweb_add_mailchimp_shortcode' );
