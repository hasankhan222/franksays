<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

eject_storage_set('blog_archive', true);

// Load scripts for 'Masonry' layout
if (substr(eject_get_theme_option('blog_style'), 0, 7) == 'masonry') {
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'classie', eject_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
	wp_enqueue_script( 'eject-gallery-script', eject_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );
}

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$eject_classes = 'posts_container '
						. (substr(eject_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap columns_padding_bottom' : 'masonry_wrap');
	$eject_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$eject_sticky_out = eject_get_theme_option('sticky_style')=='columns' 
							&& is_array($eject_stickies) && count($eject_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($eject_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$eject_sticky_out) {
		if (eject_get_theme_option('first_post_large') && !is_paged() && !in_array(eject_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($eject_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($eject_sticky_out && !is_sticky()) {
			$eject_sticky_out = false;
			?></div><div class="<?php echo esc_attr($eject_classes); ?>"><?php
		}
		get_template_part( 'content', $eject_sticky_out && is_sticky() ? 'sticky' : 'classic' );
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