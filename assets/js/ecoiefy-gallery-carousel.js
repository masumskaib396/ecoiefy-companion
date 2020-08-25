(function ($) {

"use strict";

var efyGallerySliderHandler = function ($scope, $) {

  


var postwrapper = $scope.find(".efy_gallery_slider");

  if( postwrapper.length === 0 )
    return;

/*--------------------------------------------------------------
EFY CAUSES GALLEY SLIDER JS
--------------------------------------------------------------*/
var efy_gallery_slider = $('.efy_gallery_slider');
      efy_gallery_slider.owlCarousel({
      loop:true,
      margin:0,
      nav:true,
      dots:false,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn',
      items:4,
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
              items:4
          }
      }
  });

	var efy_img_popup = $('.efy_zoom_gallery');
	  $(efy_img_popup).magnificPopup({
	      // delegate: 'a',
	      type: 'image',
	      closeOnContentClick: false,
	      closeBtnInside: false,
	      mainClass: 'mfp-with-zoom mfp-img-mobile',
	      image: {
	        verticalFit: true,
	        titleSrc: function(item) {
	        return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
	        }
	      },
	      gallery: {
	        enabled: true
	      },
	      zoom: {
	        enabled: true,
	        duration: 300, // don't foget to change the duration also in CSS
	        opener: function(element) {
	        return element.find('img');
	        }
	      }

	  });
}



 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/efy_gallery_carousel.default', efyGallerySliderHandler);

    });

})(jQuery);