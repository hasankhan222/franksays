<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

if (eject_sidebar_present()) {
	ob_start();
	$eject_sidebar_name = eject_get_theme_option('sidebar_widgets');
	eject_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($eject_sidebar_name) ) {
		dynamic_sidebar($eject_sidebar_name);
	}
	$eject_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($eject_out)) {
		$eject_sidebar_position = eject_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($eject_sidebar_position); ?> widget_area<?php if (!eject_is_inherit(eject_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(eject_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'eject_action_before_sidebar' );
				eject_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $eject_out));
				do_action( 'eject_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>