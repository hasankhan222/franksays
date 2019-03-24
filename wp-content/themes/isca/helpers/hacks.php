<?php
/**
 * Hacks to core WordPress and Jetpack to make the user experience nicer.
 *
 * @package isca
 */

/**
 * Remove Try Gutenberg Prompt.
 *
 * @see https://twitter.com/mbootsman/status/920904595823644672
 */
remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );

/**
 * Remove Jetpack promotional stuff.
 *
 * @see https://mattreport.com/disable-jetpack-upsell-ads/
 */
add_filter( 'jetpack_just_in_time_msgs', '__return_false' );
