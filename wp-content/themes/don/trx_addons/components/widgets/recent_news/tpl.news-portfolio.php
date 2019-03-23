<?php
/**
 * The "Portfolio" template to show post's content
 *
 * Used in the widget Recent News.
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */
 
$widget_args = get_query_var('trx_addons_args_recent_news');
$style = $widget_args['style'];
$number = $widget_args['number'];
$count = $widget_args['count'];
$columns = $widget_args['columns'];
$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$animation = apply_filters('trx_addons_blog_animation', '');

if ($columns > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $columns)); ?>"><?php
}
?><article 
	<?php post_class( 'post_item post_layout_'.esc_attr($style).' post_format_'.esc_attr($post_format) ); ?>
	<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
    $post_comments = get_comments_number();
	
	trx_addons_get_template_part('templates/tpl.featured.php',
								'trx_addons_args_featured',
								apply_filters('trx_addons_filter_args_featured', array(
												'post_info' => '<div class="post_info">'
																. '<h5 class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.get_the_title().'</a></h5>'
																. ( in_array( get_post_type(), array( 'post', 'attachment' ) ) 
																		? '<div class="post_meta">'
                                                        . '<span class="post_categories post_meta_item">'.trx_addons_get_post_categories().'</span>'
                                                        . '<span class="post_date post_meta_item"><a href="'.esc_url(get_permalink()).'">'.get_the_date().'</a></span>'
                                                        . '<span class="post_author post_meta_item">'.esc_attr('By ', 'eject').get_the_author_link().'</span>'
                                                        . '<a href="'. esc_url(get_comments_link()).'" class="post_meta_item post_counters_comments icon-comment-light"><span class="post_counters_number">'.esc_html($post_comments).'</span> <span class="post_counters_label">'.esc_html(_n('Comment', 'Comments', $post_comments, 'eject')).'</span></a>'

                                                        . '</div>'
																		: '')
																. '</div>',
												'thumb_size' => trx_addons_get_thumb_size('huge'),
                                                'hover' => 'none'
												), 'recent_news-portfolio')
							);
?>
</article><?php

if ($columns > 1) {
	?></div><?php
}
?>