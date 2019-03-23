<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

$eject_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$eject_post_format = get_post_format();
$eject_post_format = empty($eject_post_format) ? 'standard' : str_replace('post-format-', '', $eject_post_format);
$eject_animation = eject_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($eject_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($eject_post_format) ); ?>
	<?php echo (!eject_is_off($eject_animation) ? ' data-animation="'.esc_attr(eject_get_animation_classes($eject_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	eject_show_post_featured(array(
		'thumb_size' => eject_get_thumb_size($eject_columns==1 ? 'big' : ($eject_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($eject_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			eject_show_post_meta(apply_filters('eject_filter_post_meta_args', array(), 'sticky', $eject_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>