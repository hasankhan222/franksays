<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

$eject_blog_style = explode('_', eject_get_theme_option('blog_style'));
$eject_columns = empty($eject_blog_style[1]) ? 2 : max(2, $eject_blog_style[1]);
$eject_post_format = get_post_format();
$eject_post_format = empty($eject_post_format) ? 'standard' : str_replace('post-format-', '', $eject_post_format);
$eject_animation = eject_get_theme_option('blog_animation');
$eject_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($eject_columns).' post_format_'.esc_attr($eject_post_format) ); ?>
	<?php echo (!eject_is_off($eject_animation) ? ' data-animation="'.esc_attr(eject_get_animation_classes($eject_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($eject_image[1]) && !empty($eject_image[2])) echo intval($eject_image[1]) .'x' . intval($eject_image[2]); ?>"
	data-src="<?php if (!empty($eject_image[0])) echo esc_url($eject_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$eject_image_hover = 'icon';	//eject_get_theme_option('image_hover');
	if (in_array($eject_image_hover, array('icons', 'zoom'))) $eject_image_hover = 'dots';
	$eject_components = eject_is_inherit(eject_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: eject_array_get_keys_by_value(eject_get_theme_option('meta_parts'));
	$eject_counters = eject_is_inherit(eject_get_theme_option_from_meta('counters')) 
								? 'comments'
								: eject_array_get_keys_by_value(eject_get_theme_option('counters'));
	eject_show_post_featured(array(
		'hover' => $eject_image_hover,
		'thumb_size' => eject_get_thumb_size( strpos(eject_get_theme_option('body_style'), 'full')!==false || $eject_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($eject_components)
										? eject_show_post_meta(apply_filters('eject_filter_post_meta_args', array(
											'components' => $eject_components,
											'counters' => $eject_counters,
											'seo' => false,
											'echo' => false
											), $eject_blog_style[0], $eject_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'eject') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>