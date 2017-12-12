(function($) {

new WOW().init();


$('.slider').owlCarousel({
    loop:true,
    animateOut: 'fadeOut',
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
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
$('.footer-logos').owlCarousel({
    loop:true,
    animateOut: 'fadeOut',
    autoplay:false,
    autoplayTimeout:1000,
    autoplayHoverPause:false,
    margin: 10,
    responsive:{
        0:{
            items:3
        },
        600:{
            items:4
        },
        1000:{
            items:6
        }
    }
})
$(document).ready(function() {
    if($(window).width() <= 787) {
        $('.navbar-collapse ul').append($('#menu-top-menu li'));  
    }
});

$('.navbar .dropdown').hover(function() {
$(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
}, function() {
$(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();


}); 

$('.navbar .dropdown > a').click(function(){
location.href = this.href;
});





})(jQuery);
