(function($) {
new WOW().init();
$(".parallux").parallux();

$('.example').owlCarousel({
    loop:true,
    animateOut: 'fadeOut',
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
    dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})


})(jQuery);
