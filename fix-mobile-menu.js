jQuery(document).ready(function ($) {
    const $toggle = $('#nav-toggle');
    if (!$toggle.length) {
        return;
    }

    $toggle.wrap('<div class="nav-toggle-container"></div>');
    $toggle.addClass('fixed');

    $mobileMenu = $('#mobile-menu');
    $mobileMenu.addClass('fixed');

    $mobileMenu.wrapInner('<div class="mobile-menu-inner"></div>')
}); 