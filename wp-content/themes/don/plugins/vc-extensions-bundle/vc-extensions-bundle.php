<?php
/* Visual Composer Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('eject_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'eject_vc_extensions_theme_setup9', 9 );
	function eject_vc_extensions_theme_setup9() {
		if (eject_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'eject_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'eject_filter_merge_styles',						'eject_vc_extensions_merge_styles' );
		}
	
		if (is_admin()) {
			add_filter( 'eject_filter_tgmpa_required_plugins',		'eject_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'eject_vc_extensions_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('eject_filter_tgmpa_required_plugins',	'eject_vc_extensions_tgmpa_required_plugins');
	function eject_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (eject_storage_isset('required_plugins', 'vc-extensions-bundle')) {
			$path = eject_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			if (!empty($path) || eject_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> eject_storage_get_array('required_plugins', 'vc-extensions-bundle'),
					'slug' 		=> 'vc-extensions-bundle',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'eject_exists_vc_extensions' ) ) {
	function eject_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'eject_vc_extensions_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'eject_vc_extensions_frontend_scripts', 1100 );
	function eject_vc_extensions_frontend_scripts() {
		if (eject_is_on(eject_get_theme_option('debug_mode')) && eject_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')!='')
			wp_enqueue_style( 'eject-vc-extensions-bundle',  eject_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'eject_vc_extensions_merge_styles' ) ) {
	//Handler of the add_filter('eject_filter_merge_styles', 'eject_vc_extensions_merge_styles');
	function eject_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}
?>