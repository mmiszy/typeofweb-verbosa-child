<?php

function typeofweb_add_reading_progress() {
    if (!is_single()) {
        return;
    }

    ?>
    <progress value="0" class="reading-progress-indicator"></progress>
    <?php
}

add_action('cryout_before_content_hook', 'typeofweb_add_reading_progress');
