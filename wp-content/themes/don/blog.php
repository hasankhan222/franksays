<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$eject_content = '';
$eject_blog_archive_mask = '%%CONTENT%%';
$eject_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $eject_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($eject_content = apply_filters('the_content', get_the_content())) != '') {
		if (($eject_pos = strpos($eject_content, $eject_blog_archive_mask)) !== false) {
			$eject_content = preg_replace('/(\<p\>\s*)?'.$eject_blog_archive_mask.'(\s*\<\/p\>)/i', $eject_blog_archive_subst, $eject_content);
		} else
			$eject_content .= $eject_blog_archive_subst;
		$eject_content = explode($eject_blog_archive_mask, $eject_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) eject_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$eject_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$eject_args = eject_query_add_posts_and_cats($eject_args, '', eject_get_theme_option('post_type'), eject_get_theme_option('parent_cat'));
$eject_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($eject_page_number > 1) {
	$eject_args['paged'] = $eject_page_number;
	$eject_args['ignore_sticky_posts'] = true;
}
$eject_ppp = eject_get_theme_option('posts_per_page');
if ((int) $eject_ppp != 0)
	$eject_args['posts_per_page'] = (int) $eject_ppp;
// Make a new query
query_posts( $eject_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($eject_content) && count($eject_content) == 2) {
	set_query_var('blog_archive_start', $eject_content[0]);
	set_query_var('blog_archive_end', $eject_content[1]);
}

get_template_part('index');
?>