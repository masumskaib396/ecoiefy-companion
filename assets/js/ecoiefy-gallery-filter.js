

(function ($) {

"use strict";

var efyFilterGalleryHandler = function ($scope, $) {

var postwrapper = $scope.find('#efy_gallery_three_column');

if( postwrapper.length === 0 )
 return;

$(window).on("load" ,function(){

/*--------------------------------------------------------------
EFY GALLERY FILTER JS
------------------------------------------------------------*/
var postwrapper = $('#efy_gallery_three_column');
	var $container = $(postwrapper),
	    colWidth = function () {
	      var w = $container.width(), 
	        columnNum = 1,
	        columnWidth = 0;
	      if (w > 1200) {
	        columnNum  = 3;
	      } else if (w > 900) {
	        columnNum  = 3;
	      } else if (w > 600) {
	        columnNum  = 2;
	      } else if (w > 450) {
	        columnNum  = 2;
	      } else if (w > 385) {
	        columnNum  = 1;
	      }
	      columnWidth = Math.floor(w/columnNum);
	      $container.find('.collection-grid-item').each(function() {
	        var $item = $(this),
	          multiplier_w = $item.attr('class').match(/collection-grid-item-w(\d)/),
	          multiplier_h = $item.attr('class').match(/collection-grid-item-h(\d)/),
	          width = multiplier_w ? columnWidth*multiplier_w[1] : columnWidth,
	          height = multiplier_h ? columnWidth*multiplier_h[1]*0.4-12 : columnWidth*0.5;
	        $item.css({
	          width: width,
	          //height: height
	        });
	      });
	      return columnWidth;
	    },
	    isotope = function () {
	      $container.isotope({
	        resizable: false,
	        itemSelector: '.collection-grid-item',
	        masonry: {
	          columnWidth: colWidth(),
	          gutterWidth: 0
	        }
	      });
	    };
	  isotope();
	  $(window).resize(isotope);
	  var $optionSets = $('.watch-gallery-nav .option-set'),
	      $optionLinks = $optionSets.find('li');
	  $optionLinks.click(function(){
	  var $this = $(this);
	    var $optionSet = $this.parents('.option-set');
	    $optionSet.find('.selected').removeClass('selected');
	    $this.addClass('selected');

	    // make option object dynamically, i.e. { filter: '.my-filter-class' }
	    var options = {},
	        key = $optionSet.attr('data-option-key'),
	        value = $this.attr('data-option-value');
	    // parse 'false' as false boolean
	    value = value === 'false' ? false : value;
	    options[ key ] = value;
	    if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
	      // changes in layout modes need extra logic
	      changeLayoutMode( $this, options )
	    } else {
	      // creativewise, apply new options
	      $container.isotope( options );
	    }
	    return false;
	  });

	  
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

        elementorFrontend.hooks.addAction('frontend/element_ready/efy_gallery_filter.default', efyFilterGalleryHandler);

    });

})(jQuery);





