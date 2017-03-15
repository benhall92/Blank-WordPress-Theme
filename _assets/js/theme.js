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

				$('#mobileMenu').toggleClass('is--open');
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

		var $sidebar = $('.sidebar__widget-list');

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

	// Run necessary functions here
	Interpolate.init = function () {

		var self = this;

		self.sidebarTrigger();
		self.closeMobileMenu();
		self.mobileMenuTrigger();
		self.addDropArrows();
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