;
(function($){
    var $sliderWrap = $('div.slider-wrap');
    var $slider = $('div.slider', $sliderWrap);
    var $sliderUl = $('ul.slider-ul', $slider);
        
    var $navCircles = $('div.nav-circles', $slider);
    
    var slideWidth = $sliderWrap.width();
    $('div.slide', $slider).width(slideWidth);
    var slideCount = $('div.slide', $slider).length;
    var currentSlide = 0;
    var transitionDuration = 250;
    
    var $navCirclesUl = $('<ul/>');
    for (var i = 0; i < slideCount; i++) {
        var $navCircle = $('<a/>').attr('href', '#');
        var $navCirclesLi = $('<li/>').append($navCircle);
        $navCirclesUl.append($navCirclesLi);
    }
    $navCircles.append($navCirclesUl);
    
    var $navCirclesAnchors = $('a', $navCircles);
    $navCirclesAnchors.click(function() {
        currentSlide = $navCirclesAnchors.index($(this));
        scrollSlideByCircle($(this), $navCirclesAnchors);
    });
    
    scrollSlideByCircle($navCirclesAnchors.first(), $navCirclesAnchors);
    
    $('a.slide-nav', $slider).mouseenter(function () {
        $(this).stop().animate({
        backgroundColor: "rgba(6,2,2,0.4);"
    }, 250);
    }).mouseleave(function () {
        $(this).stop().animate({
        backgroundColor: "rgba(6,2,2,0.2);"
    }, 250);
    });
    
    $('a.slide-nav', $slider).click(function() {
        if ($(this).data('dir') === 'next') {
            currentSlide = (currentSlide + 1) % slideCount;
        } else {
            currentSlide = (currentSlide - 1) % slideCount;
            if (currentSlide < 0) {
                currentSlide = slideCount + currentSlide;
            }
        }
        
        scrollSlideByCircle($navCirclesAnchors.eq(currentSlide), $navCirclesAnchors);
    });
    
    function scrollSlide($sliderUl, slideNum, slideWidth) {
        var margin = Math.abs(slideWidth * slideNum);
        
        $sliderUl.animate({
            'margin-left'   : '-' + margin + 'px'
        }, {
            'duration'      : transitionDuration,
            'easing'        : 'swing'
        });
    }
    
    function scrollSlideByCircle($navCircle, $navCirclesAnchors) {
        $navCirclesAnchors.removeClass("selected");
        var selectSlideNum = $navCirclesAnchors.index($navCircle);
        scrollSlide($sliderUl, selectSlideNum, slideWidth);
        $navCircle.addClass('selected');
    }
    
})(jQuery)