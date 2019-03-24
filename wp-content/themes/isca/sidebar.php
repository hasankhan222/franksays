<?php
/**
 * Sidebar widgets
 *
 * @package Isca
 */

	$sidebar = isca_sidebar();

	if ( '' !== $sidebar ) {

		echo '<aside id="sidebar">';
		do_action( 'before_sidebar' );
		dynamic_sidebar( $sidebar );
		echo '</aside>';

	}
