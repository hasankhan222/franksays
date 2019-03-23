<div class="front_page_section front_page_section_woocommerce<?php
			$eject_scheme = eject_get_theme_option('front_page_woocommerce_scheme');
			if (!eject_is_inherit($eject_scheme)) echo ' scheme_'.esc_attr($eject_scheme);
			echo ' front_page_section_paddings_'.esc_attr(eject_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$eject_css = '';
		$eject_bg_image = eject_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($eject_bg_image)) 
			$eject_css .= 'background-image: url('.esc_url(eject_get_attachment_url($eject_bg_image)).');';
		if (!empty($eject_css))
			echo " style=\"{$eject_css}\"";
?>><?php
	// Add anchor
	$eject_anchor_icon = eject_get_theme_option('front_page_woocommerce_anchor_icon');	
	$eject_anchor_text = eject_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($eject_anchor_icon) || !empty($eject_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($eject_anchor_icon) ? ' icon="'.esc_attr($eject_anchor_icon).'"' : '')
										. (!empty($eject_anchor_text) ? ' title="'.esc_attr($eject_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (eject_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' eject-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$eject_css = '';
			$eject_bg_mask = eject_get_theme_option('front_page_woocommerce_bg_mask');
			$eject_bg_color = eject_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($eject_bg_color) && $eject_bg_mask > 0)
				$eject_css .= 'background-color: '.esc_attr($eject_bg_mask==1
																	? $eject_bg_color
																	: eject_hex2rgba($eject_bg_color, $eject_bg_mask)
																).';';
			if (!empty($eject_css))
				echo " style=\"{$eject_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$eject_caption = eject_get_theme_option('front_page_woocommerce_caption');
			$eject_description = eject_get_theme_option('front_page_woocommerce_description');
			if (!empty($eject_caption) || !empty($eject_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($eject_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($eject_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($eject_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($eject_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($eject_description) ? 'filled' : 'empty'; ?>"><?php
						echo wpautop(wp_kses_post($eject_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$eject_woocommerce_sc = eject_get_theme_option('front_page_woocommerce_products');
				if ($eject_woocommerce_sc == 'products') {
					$eject_woocommerce_sc_ids = eject_get_theme_option('front_page_woocommerce_products_per_page');
					$eject_woocommerce_sc_per_page = count(explode(',', $eject_woocommerce_sc_ids));
				} else {
					$eject_woocommerce_sc_per_page = max(1, (int) eject_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$eject_woocommerce_sc_columns = max(1, min($eject_woocommerce_sc_per_page, (int) eject_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$eject_woocommerce_sc}"
									. ($eject_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($eject_woocommerce_sc_ids).'"' 
											: '')
									. ($eject_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(eject_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($eject_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(eject_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(eject_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($eject_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($eject_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>