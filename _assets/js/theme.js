jQuery(document).ready(function($) {
	"use strict";

	// Create our within an object to prevent
	// any inteference from another source.
	var Interpolate = Interpolate || {};

	/**
	 * This function triggers the mobile menu
	 * when the Mobile Menu Icon is clicked
	**/
	Interpolate.mobileMenuTrigger = function() {

		var $trigger = $('#mobileMenuTrigger');

		$trigger.on('click', function () {

			console.log('clicked');

			if( $( $(window).outerWidth() <= 1024) ){

				$('#mobileMenu').toggle();
			}

		});
	}

	Interpolate.unitConvert = function () {

		var $unitConvert = $('#unitConvert');

		if( $unitConvert.length == 0 ){

			return;
		}

		var $metricUnits 	= $('#metricUnits'),
			$imperialUnits 	= $('#imperialUnits');

		$unitConvert.on('click', function () {

			if( $metricUnits.is(':visible') ){

				$metricUnits.hide(0, function () {

					$imperialUnits.show()
				});
			
			}else if( $imperialUnits.is(':visible') ){

				$imperialUnits.hide(0, function () {

					$metricUnits.show()
				});

			}

		});	

	}

	Interpolate.closeMobileMenu = function () {

		var $trigger 	= $('#menuCloseTrigger'),
			$mobileMenu = $('#mobileMenu');

		$trigger.on('click', function () {

			if( $mobileMenu.hasClass('is--open') ){

				if( $( $(window).outerWidth() <= 1024) ){

					$mobileMenu.removeClass('is--open');
				}
			}
		});
	}

	/**
	  * This function is used to show/hide the side
	  * on moile devices.
	 **/
	Interpolate.sidebarTrigger = function () {

		var $trigger = $('#sidebarMobileTrigger');

		if( $trigger.length > 0){

			$trigger.on('click', function () {

				var $this = $(this);

				$this.toggleClass('is--active');

				$this.next('ul').toggle();

			});

		}
	}

	/**
	  * This functions add dropdown arrows
	  * which are used to hide/show the submenus
	  * on mobile devices
	 **/
	Interpolate.addDropArrows = function () {

		var self 		= this,
			$parentLi 	= $('.menu-item-has-children', '.nav--mobile');

		// Perform a check to see if this is needed
		if( $parentLi.length > 0 ){

			$parentLi.each(function () {

				var $this = $(this),
					$arrow = $('<span/>', {
						html: '\u203a',
						class: 'drop-arrow'
					});

				$this.append( $arrow );

				// this function adds an eventlistener to the arrow
				self.showSubMenu($arrow);
			});
		}
	}

	/**
	  * This function adds an event listener to passed element.
	  * The element should be the arrow.
	  * This function shows or hides the relevant submenu.
	 **/
	Interpolate.showSubMenu = function (ele) {

		var $ele = $(ele);

		$ele.on('click', function () {

			var $parent = $ele.parent('li').eq(0);

			$parent.toggleClass('is--active');

			// $parent.children('.sub-menu').toggle();
		});
	}

	/**
	 * Check to see if the Mobile Menu is open
	 * When the window is resized
	**/
	Interpolate.checkMobileMenu = function () {

		var $mobileMenu = $('#mobileMenu');

		if( $(window).outerWidth() > 1024 ){

			if( $mobileMenu.hasClass('is--open') ){

				$mobileMenu.removeClass('is--open');
			}
		}
	}

	Interpolate.checkSidebar = function () {

		var $sidebar = $('.sidebar');

		if( $(window).outerWidth() > 640 ){

			if( $sidebar.css('display') == 'none' ){

				$sidebar.removeAttr('style');
			}
		
		}else{

			if ( $sidebar.css('display') == 'none' ) {

				$sidebar.removeAttr('style');
			}
		}
	}

	Interpolate.searchTrigger = function () {

		var $searchTrigger 	= $('#searchTrigger'),
			$mobileSearch 	= $('.mobile-search');

		$searchTrigger.on('click', function () {

			$mobileSearch.toggle();
		});

	};

	Interpolate.megaMenuOverlay = function () {

		var $li = $('.mega-menu > li');

		$li.mouseenter( function (e) {

			if( !$(this).hasClass('has-mega-menu') ){

				return;
			}

			if( $(e.target).closest('.mega-menu__list').length ){

				console.log('one');

				if( $('.mega-menu-overlay').is(':hidden') ){

					console.log('two');

					$('.mega-menu-overlay').show();
				}
			}

		}).mouseleave( function (e) {

			$('.mega-menu-overlay').hide();

		});
	}

	Interpolate.wishlistReverse = function () {

		var $addWishList = $('.add_to_wishlist');

		$addWishList.each(function () {

			var $this 		= $(this),
				$loading 	= $this.next('.ajax-loading');

			$loading.insertBefore($this);
		});
	}

	// Run necessary functions here
	Interpolate.init = function () {

		var self = this;

		self.sidebarTrigger();
		self.closeMobileMenu();
		self.mobileMenuTrigger();
		self.addDropArrows();
		self.megaMenuOverlay();
		self.wishlistReverse();
		self.searchTrigger();
		self.unitConvert();
	}

	// Once the window has loaded, run the following functions.
	$(window).on('load', function() {

		console.log('loaded');
		// Interpolate.addMobileMargin();

	});

	// Once the window has been resized, run the following functions.
	$(window).on('resize', function() {
		
		Interpolate.checkSidebar();
		Interpolate.checkMobileMenu();

	});

	// Run
	Interpolate.init();

});