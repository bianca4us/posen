jQuery(window).load(function(){

	/* ----------------------------------------------------------------------------
		Resize
	---------------------------------------------------------------------------- */	

	function onResize() {

		if( jQuery('.slider-container').length ) {

			var winW = jQuery(window).width();
			var winH = jQuery(window).height();
			var winRatio = Math.floor(winW / winH * 100) / 100;
			var blockRatio = 1.5;
			var h = 0;

			if( winW <= 996 ) {

				h = Math.floor(winW / blockRatio, 10);

			} else {

				h = winH - 90;

			} 

			jQuery('.slider-bg').css({'height':h});

		}
	
	}
	
	jQuery(window).resize(onResize);
	onResize();	

	// hide loading
	jQuery('#post-loading').hide();
	
});

jQuery(document).ready(function($) {

	// display loading
	$('#post-loading').show();

	/* ----------------------------------------------------------------------------
		Add class .item to .comment .depth-1
	---------------------------------------------------------------------------- */

	if( $('.comment-list').length ) {
		
		$('.comment-list').find('li').each(function() {

			if( $(this).hasClass('depth-1')) {

				$(this).addClass('item');

			}

		});

	}

	/* ----------------------------------------------------------------------------
		Masonry
	---------------------------------------------------------------------------- */
	var $container = $('#items');
		
	$container.imagesLoaded( function() {
		$container.masonry();
	});

	/* ----------------------------------------------------------------------------
		Mobile button (show / hide main menu)
	---------------------------------------------------------------------------- */

	var menu_toggle = 0;

	$( ".mobile-button" ).click(function(e) {
	
		e.preventDefault();

		$("html, body").animate({ scrollTop: 0 }, "slow");

		$('.nav').toggle();

		if( menu_toggle === 0) {

			$('.container').css({'margin-top':0});

			menu_toggle = 1;

		} else {

			$('.container').css({'margin-top':'90px'});

			menu_toggle = 0;

		}
	
	});

	/* ----------------------------------------------------
		Fluid videos (fitVids)
	---------------------------------------------------- */

	$(".video-container").fitVids();

	/* ----------------------------------------------------------------------------
		IE8 Hacks
	---------------------------------------------------------------------------- */

	if( $.browser.msie ) {

		if ( $.browser.versionNumber === 8 ) {

			// .mask-content center vertically
			$( ".mask-content" ).each(function( index, element ) {

				var parent_height = $(element).parent().height();
				var mask_height = $(element).height();
				var top = parent_height / 2 - mask_height / 2;

				$(element).css({'top':top}); 

			});

		}

	}

});
