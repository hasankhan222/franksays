<?php
/**
 * Homepage template
 *
 * @package Isca
 */

	get_header();

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content-loop' );
		}

		the_posts_pagination(
			array(
				'mid_size' => 2,
				'next_text' => esc_html__( 'Older &rsaquo;', 'isca' ),
				'prev_text' => esc_html__( '&lsaquo; Newer', 'isca' ),
			)
		);
	}

	get_footer();
