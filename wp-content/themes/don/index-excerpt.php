<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

eject_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$eject_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$eject_sticky_out = eject_get_theme_option('sticky_style')=='columns' 
							&& is_array($eject_stickies) && count($eject_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($eject_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($eject_sticky_out && !is_sticky()) {
			$eject_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $eject_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($eject_sticky_out) {
		$eject_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	eject_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>