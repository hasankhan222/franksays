/**
 * Live-update changed settings in real time in the Customizer preview.
 *
 * Filename: customizer-preview.js v1
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#javascript-driven-widget-support
 *
 * @package isca
 */

/* global jQuery, wp, isca_credits_global */

;( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Site title.
			wp.customize(
				'isca_credits_content',
				function( value ) {
					// console.log( value );
					// $( isca_credits_global.selector ).html( to );

					value.bind(
						function( to ) {
							$( isca_credits_global.selector ).html( to );
						}
					);
				}
			);

			// Header text color.
			wp.customize(
				'isca_display_credits',
				function( value ) {

					value.bind(
						function( to ) {

							if ( to ) {
								$( isca_credits_global.selector ).show();
							} else {
								$( isca_credits_global.selector ).hide();
							}

						}
					);
				}
			);

			// Fired by isca_credits expansion.
			wp.customize.preview.bind(
				'isca_credits_expand',
				function( data ) {

					// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
					if ( true === data.expanded ) {
						scroll_to( isca_credits_global.selector );
					}

				}
			);

		}
	);


	/**
	 * Scroll the page to the specified element.
	 *
	 * @param  {string} e CSS element identifier.
	 * @return {boolean}
	 */
	var scroll_to = function( e ) {

		var $target = $( e );

		if ( $target.length ) {
			var targetOffset = $target.offset().top - parseInt( $( 'html' ).css( 'margin-top' ) );
			$( 'html,body' ).animate( { scrollTop: targetOffset }, 750 );
		}

		return false;

	};

} )( jQuery );
