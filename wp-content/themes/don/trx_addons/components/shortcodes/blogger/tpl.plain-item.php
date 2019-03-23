<?php
/**
 * The style "plain" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

$args = get_query_var('trx_addons_args_sc_blogger');

if ($args['slider']) {
	?><div class="slider-slide swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = get_permalink();
$post_title = get_the_title();

$image = '';
if ( has_post_thumbnail() ) {
	$image = trx_addons_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), trx_addons_get_thumb_size('full') );
}

?><div <?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) ); ?>><?php
	// Post categories
	echo '<span class="post_meta_item post_categories">'.trx_addons_get_post_categories('', false, true).'</span>';
	// Post content
	?>
	<div class="sc_blogger_item_content entry-content"<?php if (!empty($image)) echo ' style="background-image: url('.esc_url($image).');"'; ?>>
		<div class="sc_blogger_item_wrap">
			<?php
				// Post meta
				trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
						'components' => 'date,author',
						//	'counters' => 'views,comments,likes'
					), 'sc_blogger_plain', $args['columns'])
				);
				// Post title
				the_title( sprintf( '<h5 class="sc_blogger_item_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
			?>
		</div><span class="sc_blogger_item_link_icon" href="<?php echo esc_url($link); ?>"></span></div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>