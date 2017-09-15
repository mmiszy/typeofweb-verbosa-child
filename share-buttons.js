jQuery(document).ready(function ($) {
    function openFacebookPopup(href) {
        FB.ui({
            method: 'share',
            mobile_iframe: true,
            href: href
        }, function (response) { });
    }

    function openWindowPopup(href) {
        var $window = $(window);
        var width = 575;
        var height = 520;
        var left = ($window.width() - width) / 2;
        var top = ($window.height() - height) / 2;
        var opts = 'status=1' +
            ',width=' + width +
            ',height=' + height +
            ',top=' + top +
            ',left=' + left;
            
        window.open(href, 'share', opts);
    }

    function onShareButtonClick(e) {
        e.preventDefault();

        if ($(this).data('facebook') == 'mobile') {
            var href = $(this).data('href');
            openFacebookPopup(href);
        } else {
            var href = $(this).attr('href');
            openWindowPopup(href);
        }
    }
    $('.share-buttons a').click(onShareButtonClick);
});
