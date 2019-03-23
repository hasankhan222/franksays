<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

$eject_post_id    = get_the_ID();
$eject_post_date  = eject_get_date();
$eject_post_title = get_the_title();
$eject_post_link  = get_permalink();
$eject_post_author_id   = get_the_author_meta('ID');
$eject_post_author_name = get_the_author_meta('display_name');
$eject_post_author_url  = get_author_posts_url($eject_post_author_id, '');

$eject_args = get_query_var('eject_args_widgets_posts');
$eject_show_date = isset($eject_args['show_date']) ? (int) $eject_args['show_date'] : 1;
$eject_show_image = isset($eject_args['show_image']) ? (int) $eject_args['show_image'] : 1;
$eject_show_author = isset($eject_args['show_author']) ? (int) $eject_args['show_author'] : 1;
$eject_show_counters = isset($eject_args['show_counters']) ? (int) $eject_args['show_counters'] : 1;
$eject_show_categories = isset($eject_args['show_categories']) ? (int) $eject_args['show_categories'] : 1;

$eject_output = eject_storage_get('eject_output_widgets_posts');

$eject_post_counters_output = '';
if ( $eject_show_counters ) {
	$eject_post_counters_output = '<span class="post_info_item post_info_counters">'
								. eject_get_post_counters('comments')
							. '</span>';
}


$eject_output .= '<article class="post_item with_thumb">';

if ($eject_show_image) {
	$eject_post_thumb = get_the_post_thumbnail($eject_post_id, eject_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($eject_post_thumb) $eject_output .= '<div class="post_thumb">' . ($eject_post_link ? '<a href="' . esc_url($eject_post_link) . '">' : '') . ($eject_post_thumb) . ($eject_post_link ? '</a>' : '') . '</div>';
}

$eject_output .= '<div class="post_content">'
			. ($eject_show_categories 
					? '<div class="post_categories">'
						. eject_get_post_categories()
						. $eject_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($eject_post_link ? '<a href="' . esc_url($eject_post_link) . '">' : '') . ($eject_post_title) . ($eject_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('eject_filter_get_post_info', 
								'<div class="post_info">'
									. ($eject_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($eject_post_link ? '<a href="' . esc_url($eject_post_link) . '" class="post_info_date">' : '') 
											. esc_html($eject_post_date) 
											. ($eject_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($eject_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'eject') . ' ' 
											. ($eject_post_link ? '<a href="' . esc_url($eject_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($eject_post_author_name) 
											. ($eject_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$eject_show_categories && $eject_post_counters_output
										? $eject_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
eject_storage_set('eject_output_widgets_posts', $eject_output);
?>