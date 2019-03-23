<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('eject_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'eject_revslider_theme_setup9', 9 );
	function eject_revslider_theme_setup9() {
		if (eject_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'eject_revslider_frontend_scripts', 1100 );
			add_filter( 'eject_filter_merge_styles',			'eject_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'eject_filter_tgmpa_required_plugins','eject_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'eject_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('eject_filter_tgmpa_required_plugins',	'eject_revslider_tgmpa_required_plugins');
	function eject_revslider_tgmpa_required_plugins($list=array()) {
		if (eject_storage_isset('required_plugins', 'revslider')) {
			$path = eject_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || eject_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> eject_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'eject_exists_revslider' ) ) {
	function eject_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'eject_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'eject_revslider_frontend_scripts', 1100 );
	function eject_revslider_frontend_scripts() {
		if (eject_is_on(eject_get_theme_option('debug_mode')) && eject_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'eject-revslider',  eject_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'eject_revslider_merge_styles' ) ) {
	//Handler of the add_filter('eject_filter_merge_styles', 'eject_revslider_merge_styles');
	function eject_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>