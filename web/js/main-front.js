;(function($){
    var $navBorder = $('div.main-nav div.ul-border');
    var $showNav = $('div.main-nav ul li:last-child');
    
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
})(jQuery)