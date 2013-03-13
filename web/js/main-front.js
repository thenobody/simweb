;(function($){
    var $mainNav = $('div.main-nav');
    var $navBorder = $('div.ul-border', $mainNav);
    var $showNav = $('ul li:last-child', $mainNav);
    
    var collapseDuration = 250;
    var collapsedMargin = '-' + ($navBorder.height() - $showNav.height()) + 'px';
    $navBorder.css('margin-top', collapsedMargin);
    
    $showNav.toggle(function() {
        $navBorder.animate({
            'margin-top'    : '0'
        }, {
            'duration'  : collapseDuration
        });
    }, function() {
        $navBorder.animate({
            'margin-top'    : collapsedMargin
        }, {
            'duration'      : collapseDuration
        });
    });
    
    $('a', $mainNav).each(function(index, elem) {
        var $self = $(this);
        var href = $self.attr('href');
        if (href.match(/\#.+/)) {
            $self.click(function (event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $(href).offset().top
                }, 1000);
            });
        }
    });
    
    $('div.slider div.slide-buttons a').click(function (event) {
        event.preventDefault();
        var href = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(href).offset().top
        }, 1000);
    });
    
    var $things = $('div.thing');
    $('div.thing-content').each(function (index, elem) {
        var $self = $(elem);
        $self.data('originalHeight', $self.height());
    });
    $('div.thing-content', $things).height(0);
    $('div.thing-content div.text-wrap', $things).css('opacity', 0).hide();
    
    $('div.thing-head', $things).mouseenter(function() {
        var $self = $(this);
        $self.animate({ 'border-color' : '#000'}, 500);
    });
    $('div.thing-head', $things).mouseleave(function() {
        var $self = $(this);
        $self.animate({ 'border-color' : '#000'}, 500);
    });
    
    $('div.thing-head a.close').hide();
    
    $('div.thing-head', $things).click(function() {
        var $self = $(this);
        var $thingContent = $('div.thing-content', $self.parents('div.thing'));
        if ($thingContent.height() > 0) {
            $('a.close', $self).stop().fadeOut(300);
            $('div.text-wrap', $thingContent).stop().animate({
                'opacity' : '0'
            }, 300, function () {
                $('div.text-wrap', $thingContent).hide();
            });
            $thingContent.stop().animate({
                'height' : '0px'
            }, 500);
        } else {
            $('a.close', $self).stop().fadeIn(300);
            $thingContent.stop().animate({
                'height' : $thingContent.data('originalHeight') + 'px'
            }, 500);
            $('div.text-wrap', $thingContent).show();
            $('div.text-wrap', $thingContent).stop().animate({
                'opacity' : '1'
            }, 600);
        }
    });
    
    $('a.close').click(function(event) {
        event.preventDefault();
    });
})(jQuery)