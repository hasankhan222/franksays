<?php
/**
 * Check for Jetpack logo and replace with core logo functionality.
 *
 * @package isca
 */

/**
 * Remove Jetpack site-logo functionality and replace with support for custom logo.
 *
 * @return boolean
 */
function isca_remove_site_logo() {

	// Current theme does not support Jetpack logos so exit.
	if ( ! current_theme_supports( 'site-logo' ) ) {
		return false;
	}

	// Current theme supports custom logo already so exit.
	if ( current_theme_supports( 'custom-logo' ) ) {
		return false;
	}

	// Get the site logo properties.
	$properties = get_theme_support( 'site-logo' );

	// Get image sizes.
	global $_wp_additional_image_sizes;

	// Make sure the specified size exists.
	if ( ! isset( $_wp_additional_image_sizes[ $properties[0]['size'] ] ) ) {
		return false;
	}

	// Set image properties.
	$image_properties = $_wp_additional_image_sizes[ $properties[0]['size'] ];

	// Remove the site logo support.
	remove_theme_support( 'site-logo' );

	// Add support for the custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'width' => $image_properties['width'],
			'height' => $image_properties['height'],
			'flex-height' => true,
			'flex-width' => true,
		)
	);

	/**
	 * Create a new function that outputs the custom logo (in case the jetpack
	 * logo functions are being used).
	 */
	function jetpack_the_site_logo() {
		the_custom_logo();
	}

}

/**
 * Set priority as later than the default priority so that it can remove any
 * options that might have been set.
 */
add_action( 'after_setup_theme', 'isca_remove_site_logo', 11 );
