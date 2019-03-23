<div class="front_page_section front_page_section_features<?php
			$eject_scheme = eject_get_theme_option('front_page_features_scheme');
			if (!eject_is_inherit($eject_scheme)) echo ' scheme_'.esc_attr($eject_scheme);
			echo ' front_page_section_paddings_'.esc_attr(eject_get_theme_option('front_page_features_paddings'));
		?>"<?php
		$eject_css = '';
		$eject_bg_image = eject_get_theme_option('front_page_features_bg_image');
		if (!empty($eject_bg_image)) 
			$eject_css .= 'background-image: url('.esc_url(eject_get_attachment_url($eject_bg_image)).');';
		if (!empty($eject_css))
			echo " style=\"{$eject_css}\"";
?>><?php
	// Add anchor
	$eject_anchor_icon = eject_get_theme_option('front_page_features_anchor_icon');	
	$eject_anchor_text = eject_get_theme_option('front_page_features_anchor_text');	
	if ((!empty($eject_anchor_icon) || !empty($eject_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_features"'
										. (!empty($eject_anchor_icon) ? ' icon="'.esc_attr($eject_anchor_icon).'"' : '')
										. (!empty($eject_anchor_text) ? ' title="'.esc_attr($eject_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_features_inner<?php
			if (eject_get_theme_option('front_page_features_fullheight'))
				echo ' eject-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$eject_css = '';
			$eject_bg_mask = eject_get_theme_option('front_page_features_bg_mask');
			$eject_bg_color = eject_get_theme_option('front_page_features_bg_color');
			if (!empty($eject_bg_color) && $eject_bg_mask > 0)
				$eject_css .= 'background-color: '.esc_attr($eject_bg_mask==1
																	? $eject_bg_color
																	: eject_hex2rgba($eject_bg_color, $eject_bg_mask)
																).';';
			if (!empty($eject_css))
				echo " style=\"{$eject_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_features_content_wrap content_wrap">
			<?php
			// Caption
			$eject_caption = eject_get_theme_option('front_page_features_caption');
			if (!empty($eject_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_features_caption front_page_block_<?php echo !empty($eject_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($eject_caption); ?></h2><?php
			}
		
			// Description (text)
			$eject_description = eject_get_theme_option('front_page_features_description');
			if (!empty($eject_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_features_description front_page_block_<?php echo !empty($eject_description) ? 'filled' : 'empty'; ?>"><?php echo wpautop(wp_kses_post($eject_description)); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_features_output"><?php 
				if (is_active_sidebar('front_page_features_widgets')) {
					dynamic_sidebar( 'front_page_features_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!eject_exists_trx_addons())
						eject_customizer_need_trx_addons_message();
					else
						eject_customizer_need_widgets_message('front_page_features_caption', 'ThemeREX Addons - Services');
				}
			?></div>
		</div>
	</div>
</div>