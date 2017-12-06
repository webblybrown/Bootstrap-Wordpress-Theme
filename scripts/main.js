if (!Modernizr.svg) {
  	$('img[src*="svg"]').attr('src', function() {
    	return $(this).attr('src').replace('.svg', '.png');
	});
}

//Class for Detecting Mobile devices
var isMobile = {
	Android: function() {
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function() {
		return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function() {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function() {
		return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function() {
		return navigator.userAgent.match(/IEMobile/i);
	},
	any: function() {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	}
};


if( isMobile.any() ){
	// Stuff
};



// Navigation 
$(function() {
    var mainNav = $('.site-nav'),
        navClone = mainNav.clone(),
        navBtn = $('.nav-toggle'),
        sidebarInner = $('.header-left');

    // Clone navigation into sidebar
    navClone.addClass('cloned').appendTo(sidebarInner);

    // Menu toggling
    navBtn.on('click', function() {
        $('body').toggleClass('nav-menu-open');
        return false
    });
});



if ($('.site-header .flexslider')[0]) {
	$(window).load(function() {
		$('.site-header .flexslider').flexslider({
			animation: "fade",
			animationSpeed: 750, 
			controlNav: false,
			directionNav: false,
			randomize: true
		});
	});
}

if ($('.featured-news')[0]) {
	$(window).load(function() {
		var newsScroller = $('.featured-news'),
			$window = $(window),
			flexslider;

		newsScroller.flexslider({
			animation: "slide",
			animationSpeed: 400,
			slideshow: false,
			controlNav: false,
			smoothHeight: true
		});

		//   // tiny helper function to add breakpoints
		//   function smoothHeightOn() {
		//     return (window.innerWidth < 560) ? true :
		//            (window.innerWidth < 880) ? true : false;
		//   }
		 
		// $window.resize(function() {
		//     var smoothHeightResult = smoothHeightOn();
		//     newsScroller.data('flexslider').vars.smoothHeight = smoothHeightResult;
		// });
	});
}

if ($('.news-feed')[0]) {
	(function() {
	 
	  // store the slider in a local variable
	  var $window = $(window),
	      flexslider,
	      scroller = $('.news-feed');
	 
	  // tiny helper function to add breakpoints
	  function getGridSize() {
	    return (window.innerWidth < 560) ? 1 :
	           (window.innerWidth < 880) ? 2 : 3;
	  }
	 

	 
	  $window.load(function() {
	    scroller.flexslider({
	      animation: "slide",
	      animatingSpeed: 400,
	      animationLoop: false,
	      slideshow: false,
	      controlNav: false,
	      itemWidth: 350,
	      itemMargin: 15,
	      minItems: getGridSize(), // use function to pull in initial value
	      maxItems: getGridSize(), // use function to pull in initial value
	      start: function() {
	      	var highestBox = 0;
	        $('.news-item').each(function(){
	            if($(this).height() > highestBox) 
	               highestBox = $(this).height(); 
	        });
	        $('.news-item').height(highestBox);
	      }
	    });
	  });
	 
	  // check grid size on resize event
	  $window.resize(function() {
	    var gridSize = getGridSize();
	 
	    scroller.data('flexslider').vars.minItems = gridSize;
	    scroller.data('flexslider').vars.maxItems = gridSize;
	  });
	}());
}



 $(document).ready(function($) {

 	var $accContent = $('.accordion-content'),
 		$accToggle = $('.accordion-toggle');
 	$('.accordion-content').hide();
 	$('.accordion').each(function() {
 		//$(this).find('.accordion-toggle').first().next().show();
 		$accToggle.on('click', function(){
 			if ( $(this).hasClass('active') ) {
				$(this).removeClass('active');
			} else {
				// Remove all other instances of active
				$accToggle.removeClass('active');
				$(this).addClass('active');
			}
	      	//Expand or collapse this panel
	      	$(this).next().slideToggle(300);
	      	//Hide the other panels
	      	$accContent.not($(this).next()).slideUp(300);
	    });
 	});
   
});





$(document).ready(function() {
	$('.full-feed .news-item').matchHeight();
});


if ($('audio,video')[0]) {
	$('audio,video').bind('play', function() {
	  	activated = this;
	  	$('audio,video').each(function() {
	    	if(this != activated) this.pause();
	  	});
	});
}

if ($('select')[0]) {
	$('select').minimalect();
}
