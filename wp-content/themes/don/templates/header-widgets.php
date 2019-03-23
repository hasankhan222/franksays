<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

// Header sidebar
$eject_header_name = eject_get_theme_option('header_widgets');
$eject_header_present = !eject_is_off($eject_header_name) && is_active_sidebar($eject_header_name);
if ($eject_header_present) { 
	eject_storage_set('current_sidebar', 'header');
	$eject_header_wide = eject_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($eject_header_name) ) {
		dynamic_sidebar($eject_header_name);
	}
	$eject_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($eject_widgets_output)) {
		$eject_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $eject_widgets_output);
		$eject_need_columns = strpos($eject_widgets_output, 'columns_wrap')===false;
		if ($eject_need_columns) {
			$eject_columns = max(0, (int) eject_get_theme_option('header_columns'));
			if ($eject_columns == 0) $eject_columns = min(6, max(1, substr_count($eject_widgets_output, '<aside ')));
			if ($eject_columns > 1)
				$eject_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($eject_columns).' widget ', $eject_widgets_output);
			else
				$eject_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($eject_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$eject_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($eject_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'eject_action_before_sidebar' );
				eject_show_layout($eject_widgets_output);
				do_action( 'eject_action_after_sidebar' );
				if ($eject_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$eject_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>