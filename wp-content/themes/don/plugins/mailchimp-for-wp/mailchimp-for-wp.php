<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('eject_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'eject_mailchimp_theme_setup9', 9 );
	function eject_mailchimp_theme_setup9() {
		if (eject_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'eject_mailchimp_frontend_scripts', 1100 );
			add_filter( 'eject_filter_merge_styles',					'eject_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'eject_filter_tgmpa_required_plugins',		'eject_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'eject_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('eject_filter_tgmpa_required_plugins',	'eject_mailchimp_tgmpa_required_plugins');
	function eject_mailchimp_tgmpa_required_plugins($list=array()) {
		if (eject_storage_isset('required_plugins', 'mailchimp-for-wp')) {
			$list[] = array(
				'name' 		=> eject_storage_get_array('required_plugins', 'mailchimp-for-wp'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'eject_exists_mailchimp' ) ) {
	function eject_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Hack for MailChimp - disable scroll to form, because it broke layout in the Chrome
if ( !function_exists( 'trx_addons_mailchimp_scroll_to_form' ) ) {
    add_filter( 'mc4wp_form_auto_scroll', 'trx_addons_mailchimp_scroll_to_form' );
    function trx_addons_mailchimp_scroll_to_form($scroll) {
        return false;
    }
}

// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'eject_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'eject_mailchimp_frontend_scripts', 1100 );
	function eject_mailchimp_frontend_scripts() {
		if (eject_exists_mailchimp()) {
			if (eject_is_on(eject_get_theme_option('debug_mode')) && eject_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'eject-mailchimp-for-wp',  eject_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'eject_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'eject_filter_merge_styles', 'eject_mailchimp_merge_styles');
	function eject_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (eject_exists_mailchimp()) { require_once EJECT_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>