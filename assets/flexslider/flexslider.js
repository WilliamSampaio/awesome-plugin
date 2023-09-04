// Can also be used with $(document).ready()
JQuery(window).load(function () {
    JQuery('.flexslider').flexslider({
        animation: "slide",
        touch: true,
        directionNav: false,
        smoothHeight: true,
        controlNav: true
    });
});