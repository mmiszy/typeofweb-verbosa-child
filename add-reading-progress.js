jQuery(function ($) {
    function throttle(fn, wait) {
        var time = Date.now();
        return function () {
            if ((time + wait - Date.now()) < 0) {
                fn();
                time = Date.now();
            }
        }
    }

    var $progress = $('.reading-progress-indicator');
    var $window = $(window);
    var $document = $(document);
    var $main = $('#main');
    var $disqusThread = $('#disqus_thread');

    var updateAll = function() {
        var windowHeight = $window.height();
        var articleHeight = $main.height();
        var commentsHeight = $disqusThread.height();
        max = articleHeight - windowHeight - commentsHeight;
        $progress.attr('max', max);

        updateValue();
    };
    var updateAllThrottled = throttle(updateAll, 100);

    var updateValue = function updateValue() {
        var value = $window.scrollTop();
        $progress.attr('value', value);
    };

    updateAll();
    $main.find('img').one('load', updateAllThrottled);
    $window.on('resize', updateAllThrottled);
    
    var _disqus_config = window.disqus_config;
    window.disqus_config = function () {
        if (_disqus_config) {
            _disqus_config.call(this);
        }
        this.callbacks.onReady.push(updateAllThrottled);
    }

    $document.on('scroll', updateValue);
});
