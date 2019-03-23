<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

$eject_seo = eject_is_on(eject_get_theme_option('seo_snippets'));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_'.esc_attr(get_post_type()) 
												. ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format())) 
												);
		if ($eject_seo) {
			?> itemscope="itemscope" 
			   itemprop="mainEntityOfPage" 
			   itemtype="http://schema.org/<?php echo esc_attr(eject_get_markup_schema()); ?>" 
			   itemid="<?php echo esc_url(get_the_permalink()); ?>"
			   content="<?php echo esc_attr(get_the_title()); ?>"<?php
		}
?>><?php

	do_action('eject_action_before_post_data'); 

	// Structured data snippets
	if ($eject_seo)
		get_template_part('templates/seo');

	// Featured image
	if ( eject_is_off(eject_get_theme_option('hide_featured_on_single'))
			&& !eject_sc_layouts_showed('featured') 
			&& strpos(get_the_content(), '[trx_widget_banner]')===false) {
		do_action('eject_action_before_post_featured'); 
		eject_show_post_featured();
		do_action('eject_action_after_post_featured'); 
	} else if (has_post_thumbnail()) {
		?><meta itemprop="image" "http://schema.org/ImageObject" content="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"><?php
	}

	// Title and post meta
	if ( (!eject_sc_layouts_showed('title') || !eject_sc_layouts_showed('postmeta')) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
		do_action('eject_action_before_post_title'); 
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if (!eject_sc_layouts_showed('title')) {
				the_title( '<h3 class="post_title entry-title"'.($eject_seo ? ' itemprop="headline"' : '').'>', '</h3>' );
			}
			// Post meta
			if (!eject_sc_layouts_showed('postmeta') && eject_is_on(eject_get_theme_option('show_post_meta'))) {
				eject_show_post_meta(apply_filters('eject_filter_post_meta_args', array(
					'components' => eject_array_get_keys_by_value(eject_get_theme_option('meta_parts')),
					'counters' => eject_array_get_keys_by_value(eject_get_theme_option('counters')),
					'seo' => eject_is_on(eject_get_theme_option('seo_snippets'))
					), 'single', 1)
				);
			}
			?>
		</div><!-- .post_header -->
		<?php
		do_action('eject_action_after_post_title'); 
	}

	do_action('eject_action_before_post_content'); 

	// Post content
	?>
	<div class="post_content entry-content" itemprop="articleBody">
		<?php
		the_content( );

		do_action('eject_action_before_post_pagination'); 

		wp_link_pages( array(
			'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'eject' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'eject' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );

		// Taxonomies and share
		if ( is_single() && !is_attachment() ) {

			do_action('eject_action_before_post_meta'); 

			?><div class="post_meta post_meta_single"><?php
				
				// Post taxonomies
				the_tags( '<span class="post_meta_item post_tags">', ' ', '</span>' );

				// Share
				if (eject_is_on(eject_get_theme_option('show_share_links'))) {
					eject_show_share_links(array(
							'type' => 'block',
							'caption' => '',
							'before' => '<span class="post_meta_item post_share">',
							'after' => '</span>'
						));
				}
			?></div><?php

			do_action('eject_action_after_post_meta'); 
		}
		?>
	</div><!-- .entry-content -->
	

	<?php
	do_action('eject_action_after_post_content'); 

	// Author bio.
	if ( eject_get_theme_option('show_author_info')==1 && is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {	// && is_multi_author()
		do_action('eject_action_before_post_author'); 
		get_template_part( 'templates/author-bio' );
		do_action('eject_action_after_post_author'); 
	}

	do_action('eject_action_after_post_data'); 
	?>
</article>
