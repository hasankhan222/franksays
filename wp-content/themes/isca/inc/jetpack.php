<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Isca
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function isca_jetpack_init() {

	$settings = array(
		'container' => 'main-content',
		'footer_widgets' => ( ( ( class_exists( 'Jetpack_User_Agent_Info' ) && method_exists( 'Jetpack_User_Agent_Info', 'is_ipad' ) && Jetpack_User_Agent_Info::is_ipad() ) || ( function_exists( 'jetpack_is_mobile' ) && jetpack_is_mobile() ) ) || is_active_sidebar( 'sidebar-2' ) ),
		'render'    => 'isca_infinite_scroll_render',
		'footer'    => 'footer-widgets',
	);

	add_theme_support( 'infinite-scroll', $settings );

	add_theme_support( 'jetpack-responsive-videos' );

}

add_action( 'after_setup_theme', 'isca_jetpack_init' );

/**
 * Set the code to be rendered on for calling posts, hooked to template parts when possible.
 *
 * Note: must define a loop.
 */
function isca_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();
		get_template_part( 'content-loop' );
	}

}


/**
 * get isca social links from jetpack publicise functionality
 * http://jetpack.me/support/social-links/
 */
function isca_social_links() {

	$social_links = array(
		'twitter',
		'facebook',
		'tumblr',
		'linkedin',
	);
	$links = '';

	foreach( $social_links as $social ) {

		$url = get_theme_mod( 'jetpack-' . $social );
		if ( $url ) {
			$links .= '<a href="' . esc_url( $url ) . '" class="' . esc_attr( 'social_link_' . $social ) . '" target="_blank">' . $social . '</a>';
		}

	}

	if ( $links ) {
		echo '<div class="social_links">' . $links . '</div>';
	}

}
