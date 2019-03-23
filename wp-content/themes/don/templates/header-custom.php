<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.06
 */

$eject_header_css = $eject_header_image = '';
$eject_header_video = eject_get_header_video();
if (true || empty($eject_header_video)) {
	$eject_header_image = get_header_image();
	if (eject_is_on(eject_get_theme_option('header_image_override')) && apply_filters('eject_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($eject_cat_img = eject_get_category_image()) != '')
				$eject_header_image = $eject_cat_img;
		} else if (is_singular() || eject_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$eject_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($eject_header_image)) $eject_header_image = $eject_header_image[0];
			} else
				$eject_header_image = '';
		}
	}
}

$eject_header_id = str_replace('header-custom-', '', eject_get_theme_option("header_style"));
if ((int) $eject_header_id == 0) {
	$eject_header_id = eject_get_post_id(array(
												'name' => $eject_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$eject_header_id = apply_filters('eject_filter_get_translated_layout', $eject_header_id);
}
$eject_header_meta = get_post_meta($eject_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($eject_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($eject_header_id)));
				echo !empty($eject_header_image) || !empty($eject_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($eject_header_video!='') 
					echo ' with_bg_video';
				if ($eject_header_image!='') 
					echo ' '.esc_attr(eject_add_inline_css_class('background-image: url('.esc_url($eject_header_image).');'));
				if (!empty($eject_header_meta['margin']) != '') 
					echo ' '.esc_attr(eject_add_inline_css_class('margin-bottom: '.esc_attr(eject_prepare_css_value($eject_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (eject_is_on(eject_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight eject-full-height';
				?> scheme_<?php echo esc_attr(eject_is_inherit(eject_get_theme_option('header_scheme')) 
												? eject_get_theme_option('color_scheme') 
												: eject_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($eject_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('eject_action_show_layout', $eject_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>