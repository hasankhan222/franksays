<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

eject_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', eject_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'eject-gallery-script', eject_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$eject_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$eject_sticky_out = eject_get_theme_option('sticky_style')=='columns' 
							&& is_array($eject_stickies) && count($eject_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$eject_cat = eject_get_theme_option('parent_cat');
	$eject_post_type = eject_get_theme_option('post_type');
	$eject_taxonomy = eject_get_post_type_taxonomy($eject_post_type);
	$eject_show_filters = eject_get_theme_option('show_filters');
	$eject_tabs = array();
	if (!eject_is_off($eject_show_filters)) {
		$eject_args = array(
			'type'			=> $eject_post_type,
			'child_of'		=> $eject_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'number'		=> '',
			'taxonomy'		=> $eject_taxonomy,
			'pad_counts'	=> false
		);
		$eject_portfolio_list = get_terms($eject_args);
		if (is_array($eject_portfolio_list) && count($eject_portfolio_list) > 0) {
			$eject_tabs[$eject_cat] = esc_html__('All', 'eject');
			foreach ($eject_portfolio_list as $eject_term) {
				if (isset($eject_term->term_id)) $eject_tabs[$eject_term->term_id] = $eject_term->name;
			}
		}
	}
	if (count($eject_tabs) > 0) {
		$eject_portfolio_filters_ajax = true;
		$eject_portfolio_filters_active = $eject_cat;
		$eject_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters eject_tabs eject_tabs_ajax">
			<ul class="portfolio_titles eject_tabs_titles">
				<?php
				foreach ($eject_tabs as $eject_id=>$eject_title) {
					?><li><a href="<?php echo esc_url(eject_get_hash_link(sprintf('#%s_%s_content', $eject_portfolio_filters_id, $eject_id))); ?>" data-tab="<?php echo esc_attr($eject_id); ?>"><?php echo esc_html($eject_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$eject_ppp = eject_get_theme_option('posts_per_page');
			if (eject_is_inherit($eject_ppp)) $eject_ppp = '';
			foreach ($eject_tabs as $eject_id=>$eject_title) {
				$eject_portfolio_need_content = $eject_id==$eject_portfolio_filters_active || !$eject_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $eject_portfolio_filters_id, $eject_id)); ?>"
					class="portfolio_content eject_tabs_content"
					data-blog-template="<?php echo esc_attr(eject_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(eject_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($eject_ppp); ?>"
					data-post-type="<?php echo esc_attr($eject_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($eject_taxonomy); ?>"
					data-cat="<?php echo esc_attr($eject_id); ?>"
					data-parent-cat="<?php echo esc_attr($eject_cat); ?>"
					data-need-content="<?php echo (false===$eject_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($eject_portfolio_need_content) 
						eject_show_portfolio_posts(array(
							'cat' => $eject_id,
							'parent_cat' => $eject_cat,
							'taxonomy' => $eject_taxonomy,
							'post_type' => $eject_post_type,
							'page' => 1,
							'sticky' => $eject_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		eject_show_portfolio_posts(array(
			'cat' => $eject_cat,
			'parent_cat' => $eject_cat,
			'taxonomy' => $eject_taxonomy,
			'post_type' => $eject_post_type,
			'page' => 1,
			'sticky' => $eject_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>