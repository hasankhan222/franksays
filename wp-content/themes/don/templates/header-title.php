<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

// Page (category, tag, archive, author) title

if ( eject_need_page_title() ) {
	eject_sc_layouts_showed('title', true);
	eject_sc_layouts_showed('postmeta', false);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() && false)  {
							?><div class="sc_layouts_title_meta"><?php
								eject_show_post_meta(apply_filters('eject_filter_post_meta_args', array(
									'components' => 'categories,date,counters,edit',
									'counters' => 'views,comments,likes',
									'seo' => true
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$eject_blog_title = eject_get_blog_title();
							$eject_blog_title_text = $eject_blog_title_class = $eject_blog_title_link = $eject_blog_title_link_text = '';
							if (is_array($eject_blog_title)) {
								$eject_blog_title_text = $eject_blog_title['text'];
								$eject_blog_title_class = !empty($eject_blog_title['class']) ? ' '.$eject_blog_title['class'] : '';
								$eject_blog_title_link = !empty($eject_blog_title['link']) ? $eject_blog_title['link'] : '';
								$eject_blog_title_link_text = !empty($eject_blog_title['link_text']) ? $eject_blog_title['link_text'] : '';
							} else
								$eject_blog_title_text = $eject_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($eject_blog_title_class); ?>"><?php
								$eject_top_icon = eject_get_category_icon();
								if (!empty($eject_top_icon)) {
									$eject_attr = eject_getimagesize($eject_top_icon);
									?><img src="<?php echo esc_url($eject_top_icon); ?>" alt="'.esc_attr__('img', 'eject').'" <?php if (!empty($eject_attr[3])) eject_show_layout($eject_attr[3]);?>><?php
								}
								echo wp_kses_data($eject_blog_title_text);
							?></h1>
							<?php
							if (!empty($eject_blog_title_link) && !empty($eject_blog_title_link_text)) {
								?><a href="<?php echo esc_url($eject_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($eject_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>