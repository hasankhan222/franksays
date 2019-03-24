<?php
/**
 * Include theme helpers that improve the theming experience.
 *
 * @package isca
 */

/**
 * Define a PTD debug value.
 *
 * Allows local testing.
 */
if ( ! defined( 'PTD_DEBUG' ) ) {
	define( 'PTD_DEBUG', false );
}

// Add some useful functions.
require_once 'functions.php';

// Add core and plugin hacks.
require_once 'hacks.php';

/**
 * Only include these items in the WordPress admin.
 */
if ( is_admin() ) {

	// Getting started page.
	require_once 'getting-started/index.php';

}

// Theme information in the Customizer.
require_once 'customizer-theme-info/index.php';

// Switch Jetpack logo for site logo.
require_once 'jetpack-logo/index.php';

// Support for custom footer credits/ hiding the site credits.
require_once 'custom-credits/index.php';
