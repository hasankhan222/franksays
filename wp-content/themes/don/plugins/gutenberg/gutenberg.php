<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'eject_gutenberg_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'eject_gutenberg_theme_setup9', 9 );
	function eject_gutenberg_theme_setup9() {

		add_filter( 'eject_filter_merge_styles', 'eject_gutenberg_merge_styles' );
		add_filter( 'eject_filter_merge_styles_responsive', 'eject_gutenberg_merge_styles_responsive' );
		add_action( 'enqueue_block_editor_assets', 'eject_gutenberg_editor_scripts' );

		if ( is_admin() ) {
			add_filter( 'eject_filter_tgmpa_required_plugins', 'eject_gutenberg_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'eject_gutenberg_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('eject_filter_tgmpa_required_plugins',	'eject_gutenberg_tgmpa_required_plugins');
	function eject_gutenberg_tgmpa_required_plugins( $list = array() ) {
		if ( eject_storage_isset( 'required_plugins', 'gutenberg' ) ) {
			$list[] = array(
				'name'     => eject_storage_get_array( 'required_plugins', 'gutenberg' ),
				'slug'     => 'gutenberg',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if Gutenberg is installed and activated
if ( ! function_exists( 'eject_exists_gutenberg' ) ) {
	function eject_exists_gutenberg() {
		return function_exists( 'the_gutenberg_project' ) && function_exists( 'register_block_type' );
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( ! function_exists( 'eject_gutenberg_is_preview' ) ) {
	function eject_gutenberg_is_preview() {
		return false;
	}
}

// Merge custom styles
if ( ! function_exists( 'eject_gutenberg_merge_styles' ) ) {
	//Handler of the add_filter('eject_filter_merge_styles', 'eject_gutenberg_merge_styles');
	function eject_gutenberg_merge_styles( $list ) {
		if ( eject_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg.scss';
		}
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'eject_gutenberg_merge_styles_responsive' ) ) {
	//Handler of the add_filter('eject_filter_merge_styles_responsive', 'eject_gutenberg_merge_styles_responsive');
	function eject_gutenberg_merge_styles_responsive( $list ) {
		if ( eject_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg-responsive.scss';
		}
		return $list;
	}
}


// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'eject_gutenberg_editor_scripts' ) ) {
	//Handler of the add_action( 'enqueue_block_editor_assets', 'eject_gutenberg_editor_scripts');
	function eject_gutenberg_editor_scripts() {
		// Links to selected fonts
		$links = eject_theme_fonts_links();
		if ( count( $links ) > 0 ) {
			foreach ( $links as $slug => $link ) {
				wp_enqueue_style( sprintf( 'eject-font-%s', $slug ), $link, array(), null );
			}
		}

		// Font icons styles must be loaded before main stylesheet
		wp_enqueue_style( 'eject-icons', eject_get_file_url( 'css/font-icons/css/fontello-embedded.css' ), array(), null );
		
		// Editor styles
		wp_enqueue_style( 'eject-editor-styles', eject_get_file_url( 'plugins/gutenberg/gutenberg-editor-style.css' ), array(), null );
	}
}

// Save CSS with custom colors and fonts to the gutenberg-editor-style.css
if ( ! function_exists( 'eject_gutenberg_save_css' ) ) {
	add_action( 'eject_action_save_options', 'eject_gutenberg_save_css', 20 );
	add_action( 'trx_addons_action_save_options', 'eject_gutenberg_save_css', 20 );
	function eject_gutenberg_save_css() {
		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'eject' )
				. "\n----------------------------------------------------------------------- */\n";
		// Save CSS with custom fonts and vars to the __custom.css
		$css = eject_customizer_get_css(
			array(
				'colors' => false,
			)
		);
		// Add context class to each selector
		$context = '.edit-post-visual-editor';
		$css = trim( $context . ' '
						. eject_str_replace_once(
							array(
								'}body{',
								'body{',
								'}body.',
								'}body ',
								'}',
								',body{',
								',body.',
								',body ',
								',',
								'h1,'
							),
							array(
								'}' . $context . ',' . $context . ' p{',
								$context . ',' . $context . ' p{',
								'}' . $context . '.',
								'}' . $context . ' ',
								'}' . $context . ' ',
								',' . $context . ',' . $context . ' p{',
								',' . $context . '.',
								',' . $context . ' ',
								',' . $context . ' ',
								'h1, .editor-post-title__block .editor-post-title__input,',
							),
							$css
						)
					);
		$css = str_replace( array( '",' . $context ), array( '",' ), $css );
		if ( substr( $css, -strlen( $context ) ) == $context ) {
			$css = substr( $css, 0, strlen( $css ) - strlen( $context ) );
		}
		// Save styles to the file
		eject_fpc( eject_get_file_dir( 'plugins/gutenberg/gutenberg-editor-style.css' ), $msg . $css );
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( eject_exists_gutenberg() ) {
	require_once EJECT_THEME_DIR . 'plugins/gutenberg/gutenberg-styles.php';
}
