<?php
/**
 * Display file attachments
 *
 * @package Isca
 */

	get_header();
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', 'attachment' );
			comments_template( '', true );
		}
	}

	get_footer();
