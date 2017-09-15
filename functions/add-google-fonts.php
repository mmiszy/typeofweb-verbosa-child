<?php

function typeofweb_add_fonts() {
    ?>
<script>
(function() {
    var link = document.createElement('link');
    link.rel = "stylesheet";
    link.href = "https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&amp;subset=latin-ext";
    document.querySelector("head").appendChild(link);
})();
</script>
    <?php
}
add_action( 'wp_footer', 'typeofweb_add_fonts' );
