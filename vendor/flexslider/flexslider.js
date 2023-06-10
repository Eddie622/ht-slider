jQuery(window).load(function() {
    // https://gist.github.com/warrendholmes/9481310
    jQuery('.flexslider').flexslider({
        animation: "slide",
        touch: true,
        directionNav: false,
        smoothHeight: true,
        controlNav: SLIDER_OPTIONS.controlNav,
    });
});