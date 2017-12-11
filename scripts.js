(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
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
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
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

WebFontConfig = {
  google: {
    families: ['Lato:400, 700']
  },
  timeout: 2000
};
(function(d) {
  var wf = d.createElement('script'), s = d.scripts[0];
  wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js';
  s.parentNode.insertBefore(wf, s);
})(document);

},{}]},{},[1])