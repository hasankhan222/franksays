<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.10
 */

// Footer sidebar
$eject_footer_name = eject_get_theme_option('footer_widgets');
$eject_footer_present = !eject_is_off($eject_footer_name) && is_active_sidebar($eject_footer_name);
if ($eject_footer_present) { 
	eject_storage_set('current_sidebar', 'footer');
	$eject_footer_wide = eject_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($eject_footer_name) ) {
		dynamic_sidebar($eject_footer_name);
	}
	$eject_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($eject_out)) {
		$eject_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $eject_out);
		$eject_need_columns = true;	//or check: strpos($eject_out, 'columns_wrap')===false;
		if ($eject_need_columns) {
			$eject_columns = max(0, (int) eject_get_theme_option('footer_columns'));
			if ($eject_columns == 0) $eject_columns = min(4, max(1, substr_count($eject_out, '<aside ')));
			if ($eject_columns > 1)
				$eject_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($eject_columns).' widget ', $eject_out);
			else
				$eject_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($eject_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$eject_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($eject_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'eject_action_before_sidebar' );
				eject_show_layout($eject_out);
				do_action( 'eject_action_after_sidebar' );
				if ($eject_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$eject_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>