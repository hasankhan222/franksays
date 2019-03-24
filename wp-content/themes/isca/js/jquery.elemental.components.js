/*!
 * jquery.elemental.components.js v1
 * Created by Ben Gillbanks <http://www.binarymoon.co.uk/>
 * Available under GPL2 license
 */
(function ($) {

	var isiOS = navigator.userAgent.match(/iPad|iPhone|iPod/i) != null;

	// DROP DOWN MENUS
	$.fn.elementalNav = function( options ) {

		var defaults = {};
		options = $.extend(defaults, options);

		return this.each(function () {
			var $this = $(this);

			$this.find('li')[($.fn.hoverIntent) ? 'hoverIntent' : 'hover'](function(){
				$(this).addClass('hover');
				$('ul:first',this).stop(true, true).fadeIn(150);
			}, function(){
				$(this).removeClass('hover');
				$('ul:first',this).delay(400).fadeOut(150);
			});

			$this.find('li:has(ul)').find('a:first').addClass('has-children');
		});
	};

	$.fn.elementalInit = function() {

		// remove hover on touch devices
		if ( isiOS ) {
			$('body').children().on('click', $.noop);
		}

	};

})(jQuery);