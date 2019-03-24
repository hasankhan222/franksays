<?php
/**
 * Useful functions :).
 *
 * @package isca
 */

/**
 * Is the current theme a child theme or not?
 *
 * @return boolean
 */
function isca_is_child_theme() {

	$theme = wp_get_theme();
	$theme_name = strtolower( $theme->get( 'Name' ) );

	if ( 'isca' !== $theme_name ) {
		return true;
	}

	return false;

}
