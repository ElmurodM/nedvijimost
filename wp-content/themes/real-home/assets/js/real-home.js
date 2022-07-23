/**
 * File real-home.js.
 *
 * Theme main js
 * @package Real_Home
 */

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();

$ = jQuery
jQuery(document).ready(function () {


	/* Mean Menu */
	let mobileMeanMenuPosition 	= $('#mobile-header .col-has-toggle-menu-element').data('meanmenu');
	$('.header-toggle-menu-wrap .menu-top-menu-container').meanmenu({
		meanMenuContainer: '.header-toggle-menu-wrap .main-navigation',
		meanScreenWidth: "1023",
		meanRevealPosition: mobileMeanMenuPosition,
	});

	if ($(window).width() < 1024) {
		var windowWidth = jQuery(window).width();
		var nav = ".main-navigation";
		if (windowWidth > 1023) {
			jQuery(nav).off('mouseenter', 'li');
			jQuery(nav).off('mouseleave', 'li');
			jQuery(nav).off('click', 'li');
			jQuery(nav).off('click', 'a');
			jQuery(nav).on('mouseenter', 'li', function() {
				jQuery(this).children('ul').stop().hide();
				jQuery(this).children('ul').slideDown(400);
			});
			jQuery(nav).on('mouseleave', 'li', function() {
				jQuery(this).children('ul').stop().slideUp(350);
			});
		}

		//keyboard navigation for mean menu
		var myEvents = {
			click: function(e) {
				if ( jQuery(this).hasClass('menu-item-has-children') ) {
					jQuery(this).find('.mean-expand').addClass('mean-clicked');
				}
				jQuery(this).siblings('li').find('.mean-expand').removeClass('mean-clicked');
				jQuery(this).children('.sub-menu').show().end().siblings('li').find('ul').hide();

			},

			keydown: function(e) {
				e.stopPropagation();
				if (e.keyCode == 9) {
					if (!e.shiftKey &&
						( jQuery('.mean-bar li').index( jQuery(this) ) == ( jQuery('.mean-bar li').length-1 ) ) ){
						jQuery('.meanclose').trigger('click');
					}  else if( jQuery('.mean-bar li').index( jQuery(this) ) == 0 ) {
						$('.meanclose').removeClass('onfocus');
					}
					else if (e.shiftKey && jQuery('.mean-bar li').index(jQuery(this)) === 0)
						jQuery('.mean-bar ul:first > li:last').focus().blur();
				}
			},

			keyup: function(e) {
				e.stopPropagation();
				if (e.keyCode == 9) {
					if (myEvents.cancelKeyup) myEvents.cancelKeyup = false;
					else myEvents.click.apply(this, arguments);
				}
			}
		}
		jQuery(document)
			.on('click', 'li', myEvents.click)
			.on('keydown', 'li', myEvents.keydown)
			.on('keyup', 'li', myEvents.keyup);
		jQuery('.mean-bar li').each(function(i) { this.tabIndex = i; });
	}

 $('.site-header .search-toggle').on("click",function(){
		Search();
    });

//  search focus

  function Search(e){
    $('.site-header .header-search-section').toggleClass('active');
    setTimeout(function(){
        $('.header-search-section form input[type="search"]').focus();
      }, 500 );
    var focusableEls = $('.header-search-section input[type="submit"]:not([disabled]), .header-search-section input:not([disabled]) ');
        var firstFocusableEl = focusableEls[0];
        var lastFocusableEl = focusableEls[focusableEls.length - 1];
        var KEYCODE_TAB = 9;
        $('.header-search-section').on('keydown', function (e) {
            if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
                if ( e.shiftKey && document.activeElement === lastFocusableEl ) {
                  e.preventDefault();
                  $('.header-search-section form input[type="search"]').focus();
                } else {
                  if (document.activeElement === lastFocusableEl) {
                      $('.header-search-section').removeClass('active');
                  }
                }
            }
        });
  }
  $(document).on('keyup', function(e){
     if ( e.keyCode === 27 && $('.header-search-section').hasClass('active') ) {
            $(".header-search-section").removeClass('active');
        }
  });



	/* back-to-top button*/
	$('.back-to-top').hide();
	$('.back-to-top').on("click", function (e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, 'slow');
	});

	$(window).scroll(function () {
		var scrollheight = 400;
		if ($(window).scrollTop() > scrollheight) {
			$('.back-to-top').fadeIn();

		} else {
			$('.back-to-top').fadeOut();
		}
	});


	// slider
	$('.banner-slider').slick({
		dots: true,
		infinite: true,
		speed: 700,
		slidesToShow: 1,
		autoplay: true,
		fade: true,
		arrows: false,
	});
	$('.testimonial-item-wrap').slick({
		dots: true,
		infinite: true,
		speed: 700,
		slidesToShow: 1,
		autoplay: true,
		fade: true,
		arrows: false,
	});
	$('.agent-item-slider').slick({
		dots: false,
		infinite: true,
		speed: 700,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: true,
		fade: false,
		arrows: true,
		responsive: [{
			breakpoint: 991,
			settings: {
				slidesToShow: 2,
			}
		},
			{
				breakpoint: 568,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});
	$('.partner-item-wrapper').slick({
		dots: false,
		infinite: true,
		speed: 700,
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: true,
		fade: false,
		arrows: true,
		responsive: [{
			breakpoint: 991,
			settings: {
				slidesToShow: 3,
			}
		},
			{
				breakpoint: 568,
				settings: {
					slidesToShow: 2,
				}
			}, {
				breakpoint: 479,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});

	/*isotope*/
	/*active class adding and removing */

	/*isotope */
	var $isotop_container = $('.property-location-wrap .columns').isotope({
		itemSelector: '.column',
		columnWidth: '.column',
		isFitWidth: true
	});
	$isotop_container.isotope({
		filter: '*'
	});

	// layout Isotope after each image loads
	$isotop_container.imagesLoaded().progress(function () {
		$isotop_container.isotope('layout');
	});

	// custom tab
	jQuery('.custom-tabs .tab-links a').on('click', function (e) {
		var currentAttrValue = jQuery(this).attr('href');

		// Show/Hide custom-tabs
		jQuery('.custom-tabs ' + currentAttrValue).fadeIn(400).siblings().hide();

		// Change/remove current tab to active
		jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

		e.preventDefault();
	});

	// Sticky Sidebar
	if ( REAL_HOME.sticky_sidebar ){
		$('.has-sticky-sidebar .have-sidebar #primary, .has-sticky-sidebar .have-sidebar #secondary').theiaStickySidebar({
			// Settings
			additionalMarginTop: 30
		});
	}
});
