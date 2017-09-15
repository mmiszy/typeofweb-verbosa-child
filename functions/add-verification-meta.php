<?php

function add_verification_meta () {
    ?>
<noscript>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
</noscript>
<meta name="google-site-verification" content="7VIfodaeFWPdFg9rLt41JXG-1tkpPf3v0Y2I6Xr1c9Y" />
<meta name="p:domain_verify" content="5702430adee069d8a8fb92c03aa252da" />
<meta name="msvalidate.01" content="2D1EE4B00F9070B6B25A4CBDA8D77BF2" />
    <?php
}
add_action('wp_head', 'add_verification_meta');
