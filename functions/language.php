<?php

function setup() {
    load_child_theme_textdomain( 'verbosa', get_stylesheet_directory() . '/languages' );
}
add_action( 'init', 'setup' );