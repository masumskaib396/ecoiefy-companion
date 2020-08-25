

(function ($) {

"use strict";

var efyTesimonialHandler = function ($scope, $) {

  


var postwrapper = $scope.find(".efy_three_item_slider");

  if( postwrapper.length === 0 )
    return;

/*--------------------------------------------------------------
EFY CAUSES THREE ITEM SLIDER JS
--------------------------------------------------------------*/
var postwrapper = $('.efy_three_item_slider');

  postwrapper.owlCarousel({
      loop:true,
      margin:30,
      nav:true,
      dots:false,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn',
      items:3,
      navText: ["<i class=\"icon icon-ar-right\"></i>",
        "<i class=\"icon icon-ar-left\"></i>"],
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          768:{
              items:1 
          },
          1000:{
              items:3
          }
      }
  });

}

 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/ecoiefy_testimonial.default', efyTesimonialHandler);

    });

})(jQuery);





