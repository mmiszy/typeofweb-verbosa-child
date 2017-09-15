<?php

function typeofweb_add_service_worker() {
    ?>
<script>
(function () {
    var hasServiceWorker = ('serviceWorker' in navigator);
    var hasLocalStorage = ('localStorage' in window);
    try { // Safari private mode
        localStorage['test.typeofweb.com'] = 'test.typeofweb.com';
        localStorage.removeItem('test.typeofweb.com')
    } catch (e) {
        hasLocalStorage = false;
    }

    function saveStylesheet(src, stylesheet) {
        if (!hasLocalStorage || hasServiceWorker) { // don't save if we cache with service worker already
            return;
        }
        try { // Safari...
            localStorage[src] = stylesheet;
        } catch (e) {}
    }

    function loadFont(src) {
        if (hasLocalStorage && localStorage[src]) {
            return injectStyle(localStorage[src]);
        }
        loadStylesheet(src, function (stylesheet) {
            injectStyle(stylesheet);
            saveStylesheet(src, stylesheet);
        });
    }

    function injectStyle(stylesheet) {
        var style = document.createElement('style');
        document.head.appendChild(style);
        style.textContent = stylesheet;
    }

    function loadStylesheet(src, cb) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', src);
        xhr.addEventListener('load', function (e) {
            cb(e.currentTarget.responseText);
        });
        xhr.send();
    }

    loadFont('https://typeofweb.com/wp-content/themes/typeofweb-verbosa-child/inlined-fonts.css?ver=4.8.1');

    
    if (hasServiceWorker) {
        navigator
            .serviceWorker
            .register('/service-worker.js')
            .then(function() {
                console.log('Service Worker Registered');
            })
            .catch(function(error) {
                console.log('Service Worker Registration failed:', error);
            });
    } else {
        console.log('Service worker not supported');
    }
}());
</script>
    <?php
}

add_action( 'wp_head', 'typeofweb_add_service_worker' );
