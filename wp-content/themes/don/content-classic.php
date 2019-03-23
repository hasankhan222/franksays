<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

$eject_blog_style = explode('_', eject_get_theme_option('blog_style'));
$eject_columns = empty($eject_blog_style[1]) ? 2 : max(2, $eject_blog_style[1]);
$eject_expanded = !eject_sidebar_present() && eject_is_on(eject_get_theme_option('expand_content'));
$eject_post_format = get_post_format();
$eject_post_format = empty($eject_post_format) ? 'standard' : str_replace('post-format-', '', $eject_post_format);
$eject_animation = eject_get_theme_option('blog_animation');
$eject_components = eject_is_inherit(eject_get_theme_option_from_meta('meta_parts')) 
							? 'categories,date,counters'.($eject_columns < 3 ? ',edit' : '')
							: eject_array_get_keys_by_value(eject_get_theme_option('meta_parts'));
$eject_counters = eject_is_inherit(eject_get_theme_option_from_meta('counters')) 
							? 'comments'
							: eject_array_get_keys_by_value(eject_get_theme_option('counters'));

?><div class="<?php echo $eject_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($eject_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($eject_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($eject_columns)
					. ' post_layout_'.esc_attr($eject_blog_style[0]) 
					. ' post_layout_'.esc_attr($eject_blog_style[0]).'_'.esc_attr($eject_columns)
					); ?>
	<?php echo (!eject_is_off($eject_animation) ? ' data-animation="'.esc_attr(eject_get_animation_classes($eject_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	eject_show_post_featured( array( 'thumb_size' => eject_get_thumb_size($eject_blog_style[0] == 'classic'
													? (strpos(eject_get_theme_option('body_style'), 'full')!==false 
															? ( $eject_columns > 2 ? 'big' : 'huge' )
															: (	$eject_columns > 2
																? ($eject_expanded ? 'med' : 'small')
																: ($eject_expanded ? 'big' : 'med')
																)
														)
													: (strpos(eject_get_theme_option('body_style'), 'full')!==false 
															? ( $eject_columns > 2 ? 'masonry-big' : 'full' )
															: (	$eject_columns <= 2 && $eject_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($eject_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('eject_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('eject_action_before_post_meta'); 

			// Post meta
			if (!empty($eject_components))
				eject_show_post_meta(apply_filters('eject_filter_post_meta_args', array(
					'components' => $eject_components,
					'counters' => $eject_counters,
					'seo' => false
					), $eject_blog_style[0], $eject_columns)
				);

			do_action('eject_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$eject_show_learn_more = false; //!in_array($eject_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($eject_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($eject_post_format == 'quote') {
				if (($quote = eject_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					eject_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($eject_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($eject_components))
				eject_show_post_meta(apply_filters('eject_filter_post_meta_args', array(
					'components' => $eject_components,
					'counters' => $eject_counters
					), $eject_blog_style[0], $eject_columns)
				);
		}
		// More button
		if ( $eject_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'eject'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>