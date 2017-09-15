<?php

function typeofweb_add_social() {
    ?>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: "1709793622637583",
            autoLogAppEvents: true,
            xfbml: true,
            version: "v2.10"
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/pl_PL/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, "script", "facebook-jssdk"));
</script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script async src="https://codepen.io/eijs.js"></script>
    <?php
}
add_action( 'wp_footer', 'typeofweb_add_social' );
