<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.10
 */

$eject_footer_scheme =  eject_is_inherit(eject_get_theme_option('footer_scheme')) ? eject_get_theme_option('color_scheme') : eject_get_theme_option('footer_scheme');
$eject_footer_id = str_replace('footer-custom-', '', eject_get_theme_option("footer_style"));
if ((int) $eject_footer_id == 0) {
	$eject_footer_id = eject_get_post_id(array(
												'name' => $eject_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$eject_footer_id = apply_filters('eject_filter_get_translated_layout', $eject_footer_id);
}
$eject_footer_meta = get_post_meta($eject_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($eject_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($eject_footer_id))); 
						if (!empty($eject_footer_meta['margin']) != '') 
							echo ' '.esc_attr(eject_add_inline_css_class('margin-top: '.esc_attr(eject_prepare_css_value($eject_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($eject_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('eject_action_show_layout', $eject_footer_id);
	?>
</footer><!-- /.footer_wrap -->
