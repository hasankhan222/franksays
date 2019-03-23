<div class="front_page_section front_page_section_contacts<?php
			$eject_scheme = eject_get_theme_option('front_page_contacts_scheme');
			if (!eject_is_inherit($eject_scheme)) echo ' scheme_'.esc_attr($eject_scheme);
			echo ' front_page_section_paddings_'.esc_attr(eject_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$eject_css = '';
		$eject_bg_image = eject_get_theme_option('front_page_contacts_bg_image');
		if (!empty($eject_bg_image)) 
			$eject_css .= 'background-image: url('.esc_url(eject_get_attachment_url($eject_bg_image)).');';
		if (!empty($eject_css))
			echo " style=\"{$eject_css}\"";
?>><?php
	// Add anchor
	$eject_anchor_icon = eject_get_theme_option('front_page_contacts_anchor_icon');	
	$eject_anchor_text = eject_get_theme_option('front_page_contacts_anchor_text');	
	if ((!empty($eject_anchor_icon) || !empty($eject_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($eject_anchor_icon) ? ' icon="'.esc_attr($eject_anchor_icon).'"' : '')
										. (!empty($eject_anchor_text) ? ' title="'.esc_attr($eject_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (eject_get_theme_option('front_page_contacts_fullheight'))
				echo ' eject-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$eject_css = '';
			$eject_bg_mask = eject_get_theme_option('front_page_contacts_bg_mask');
			$eject_bg_color = eject_get_theme_option('front_page_contacts_bg_color');
			if (!empty($eject_bg_color) && $eject_bg_mask > 0)
				$eject_css .= 'background-color: '.esc_attr($eject_bg_mask==1
																	? $eject_bg_color
																	: eject_hex2rgba($eject_bg_color, $eject_bg_mask)
																).';';
			if (!empty($eject_css))
				echo " style=\"{$eject_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$eject_caption = eject_get_theme_option('front_page_contacts_caption');
			$eject_description = eject_get_theme_option('front_page_contacts_description');
			if (!empty($eject_caption) || !empty($eject_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($eject_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($eject_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($eject_caption);
					?></h2><?php
				}
			
				// Description
				if (!empty($eject_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($eject_description) ? 'filled' : 'empty'; ?>"><?php
						echo wpautop(wp_kses_post($eject_description));
					?></div><?php
				}
			}

			// Content (text)
			$eject_content = eject_get_theme_option('front_page_contacts_content');
			$eject_layout = eject_get_theme_option('front_page_contacts_layout');
			if ($eject_layout == 'columns' && (!empty($eject_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($eject_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($eject_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($eject_content);
				?></div><?php
			}

			if ($eject_layout == 'columns' && (!empty($eject_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$eject_sc = eject_get_theme_option('front_page_contacts_shortcode');
			if (!empty($eject_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($eject_sc) ? 'filled' : 'empty'; ?>"><?php
					eject_show_layout(do_shortcode($eject_sc));
				?></div><?php
			}

			if ($eject_layout == 'columns' && (!empty($eject_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>