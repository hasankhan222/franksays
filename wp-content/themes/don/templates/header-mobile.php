<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(eject_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('eject_logo_args', array('type' => 'mobile'));
		get_template_part( 'templates/header-logo' );
		set_query_var('eject_logo_args', array());

		// Mobile menu
		$eject_menu_mobile = eject_get_nav_menu('menu_mobile');
		if (empty($eject_menu_mobile)) {
			$eject_menu_mobile = apply_filters('eject_filter_get_mobile_menu', '');
			if (empty($eject_menu_mobile)) $eject_menu_mobile = eject_get_nav_menu('menu_main');
			if (empty($eject_menu_mobile)) $eject_menu_mobile = eject_get_nav_menu();
		}
		if (!empty($eject_menu_mobile)) {
			if (!empty($eject_menu_mobile))
				$eject_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$eject_menu_mobile
					);
			if (strpos($eject_menu_mobile, '<nav ')===false)
				$eject_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $eject_menu_mobile);
			eject_show_layout(apply_filters('eject_filter_menu_mobile_layout', $eject_menu_mobile));
		}

		// Social icons
		eject_show_layout(eject_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
