/*!
 * main.js v1
 * Created by Ben Gillbanks <http://www.binarymoon.co.uk/>
 * Available under GPL2 license
 */

;( function( $ ) {

	$( document ).ready( function() {

		// Set default heights for social media widgets

		// Twitter
		$( 'a.twitter-timeline' ).each( function() {

			var thisHeight = $( this ).attr( 'height' );
			$( this ).parent().css( 'min-height', thisHeight + 'px' );

		} );

		// Facebook
		$( '.fb-page' ).each( function() {

			var $set_height = $( this ).data( 'height' );
			var $show_facepile = $( this ).data( 'show-facepile' );
			var $show_posts = $( this ).data( 'show-posts' ); // AKA stream
			var $min_height = $set_height; // set the default 'min-height'

			// These values are defaults from the FB widget.
			var $no_posts_no_faces = 130;
			var $no_posts = 220;

			if ( $show_posts ) {

				// Showing posts; may also be showing faces and/or cover - the latter doesn't affect the height at all.
				$min_height = $set_height;

			} else if ( $show_facepile ) {

				// Showing facepile with or without cover image - both would be same height.
				// If the user selected height is lower than the no_posts height, we'll use that instead
				$min_height = ( $set_height < $no_posts ) ? $set_height : $no_posts;

			} else {

				// Either just showing cover, or nothing is selected (both are same height).
				// If the user selected height is lower than the no_posts_no_faces height, we'll use that instead
				$min_height = ( $set_height < $no_posts_no_faces ) ? $set_height : $no_posts_no_faces;

			}

			// apply min-height to .fb-page container
			$( this ).css( 'min-height', $min_height + 'px' );

		} );

		$( '.menu ul' ).elementalNav();
		$().elementalInit();

		$( '.nav' ).responsiveNavigation({
			breakpoint:720
		});

		// masonry layout

		$( window ).load( function() {

			if ( $.isFunction( $.fn.masonry ) ) {

				$( '#footer-widgets' ).masonry( {
					itemSelector: '.widget',
					isAnimated: true
				} );

			}

		} );

	});

} )( jQuery );
