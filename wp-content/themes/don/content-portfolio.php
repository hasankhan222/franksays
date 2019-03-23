<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($eject_columns).' post_format_'.esc_attr($eject_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!eject_is_off($eject_animation) ? ' data-animation="'.esc_attr(eject_get_animation_classes($eject_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$eject_image_hover = eject_get_theme_option('image_hover');
	// Featured image
	eject_show_post_featured(array(
		'thumb_size' => eject_get_thumb_size(strpos(eject_get_theme_option('body_style'), 'full')!==false || $eject_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $eject_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $eject_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>