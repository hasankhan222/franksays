<div class="front_page_section front_page_section_googlemap<?php
			$eject_scheme = eject_get_theme_option('front_page_googlemap_scheme');
			if (!eject_is_inherit($eject_scheme)) echo ' scheme_'.esc_attr($eject_scheme);
			echo ' front_page_section_paddings_'.esc_attr(eject_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$eject_css = '';
		$eject_bg_image = eject_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($eject_bg_image)) 
			$eject_css .= 'background-image: url('.esc_url(eject_get_attachment_url($eject_bg_image)).');';
		if (!empty($eject_css))
			echo " style=\"{$eject_css}\"";
?>><?php
	// Add anchor
	$eject_anchor_icon = eject_get_theme_option('front_page_googlemap_anchor_icon');	
	$eject_anchor_text = eject_get_theme_option('front_page_googlemap_anchor_text');	
	if ((!empty($eject_anchor_icon) || !empty($eject_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($eject_anchor_icon) ? ' icon="'.esc_attr($eject_anchor_icon).'"' : '')
										. (!empty($eject_anchor_text) ? ' title="'.esc_attr($eject_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (eject_get_theme_option('front_page_googlemap_fullheight'))
				echo ' eject-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$eject_css = '';
			$eject_bg_mask = eject_get_theme_option('front_page_googlemap_bg_mask');
			$eject_bg_color = eject_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($eject_bg_color) && $eject_bg_mask > 0)
				$eject_css .= 'background-color: '.esc_attr($eject_bg_mask==1
																	? $eject_bg_color
																	: eject_hex2rgba($eject_bg_color, $eject_bg_mask)
																).';';
			if (!empty($eject_css))
				echo " style=\"{$eject_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$eject_layout = eject_get_theme_option('front_page_googlemap_layout');
			if ($eject_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$eject_caption = eject_get_theme_option('front_page_googlemap_caption');
			$eject_description = eject_get_theme_option('front_page_googlemap_description');
			if (!empty($eject_caption) || !empty($eject_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($eject_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($eject_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($eject_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post($eject_caption);
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($eject_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($eject_description) ? 'filled' : 'empty'; ?>"><?php
							echo wpautop(wp_kses_post($eject_description));
						?></div><?php
					}
				if ($eject_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$eject_content = eject_get_theme_option('front_page_googlemap_content');
			if (!empty($eject_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($eject_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($eject_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($eject_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($eject_content);
				?></div><?php
	
				if ($eject_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($eject_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!eject_exists_trx_addons())
						eject_customizer_need_trx_addons_message();
					else
						eject_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($eject_layout == 'columns' && (!empty($eject_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>