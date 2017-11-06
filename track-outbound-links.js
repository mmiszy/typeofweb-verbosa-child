jQuery(document).ready(function ($) {
    $('a').click(function (e) {
        var $a = $(this);
        var url = $a.attr('href');
        var target = $a.attr('target');
        window[window.GoogleAnalyticsObject] && window[window.GoogleAnalyticsObject]('send', 'event', 'outbound', 'click', url, {
            hitCallback: function () {
                console.log(target?target:'no target');
                if (target !== '_blank') {
                    window.location.href = url;
                }
            }
        });
    })
});
