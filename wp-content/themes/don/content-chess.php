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
$eject_columns = empty($eject_blog_style[1]) ? 1 : max(1, $eject_blog_style[1]);
$eject_expanded = !eject_sidebar_present() && eject_is_on(eject_get_theme_option('expand_content'));
$eject_post_format = get_post_format();
$eject_post_format = empty($eject_post_format) ? 'standard' : str_replace('post-format-', '', $eject_post_format);
$eject_animation = eject_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($eject_columns).' post_format_'.esc_attr($eject_post_format) ); ?>
	<?php echo (!eject_is_off($eject_animation) ? ' data-animation="'.esc_attr(eject_get_animation_classes($eject_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($eject_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	eject_show_post_featured( array(
											'class' => $eject_columns == 1 ? 'eject-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => eject_get_thumb_size(
																	strpos(eject_get_theme_option('body_style'), 'full')!==false
																		? ( $eject_columns > 1 ? 'huge' : 'original' )
																		: (	$eject_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('eject_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('eject_action_before_post_meta'); 

			// Post meta
			$eject_components = eject_is_inherit(eject_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date'.($eject_columns < 3 ? ',counters' : '').($eject_columns == 1 ? ',edit' : '')
										: eject_array_get_keys_by_value(eject_get_theme_option('meta_parts'));
			$eject_counters = eject_is_inherit(eject_get_theme_option_from_meta('counters')) 
										? 'comments'
										: eject_array_get_keys_by_value(eject_get_theme_option('counters'));
			$eject_post_meta = empty($eject_components) 
										? '' 
										: eject_show_post_meta(apply_filters('eject_filter_post_meta_args', array(
												'components' => $eject_components,
												'counters' => $eject_counters,
												'seo' => false,
												'echo' => false
												), $eject_blog_style[0], $eject_columns)
											);
			eject_show_layout($eject_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$eject_show_learn_more = !in_array($eject_post_format, array('link', 'aside', 'status', 'quote'));
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
				eject_show_layout($eject_post_meta);
			}
			// More button
			if ( $eject_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'eject'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>