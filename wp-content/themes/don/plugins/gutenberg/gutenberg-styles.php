<?php
// Add plugin-specific vars to the custom CSS
if ( ! function_exists( 'basekit_gutenberg_add_theme_vars' ) ) {
	add_filter( 'basekit_filter_add_theme_vars', 'basekit_gutenberg_add_theme_vars', 10, 2 );
	function basekit_gutenberg_add_theme_vars( $rez, $vars ) {
		return $rez;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'basekit_gutenberg_get_css' ) ) {
	add_filter( 'basekit_filter_get_css', 'basekit_gutenberg_get_css', 10, 2 );
	function basekit_gutenberg_get_css( $css, $args ) {

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			extract( $args['vars'] );
			$css['vars'] .= <<<CSS

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

CSS;
		}

		return $css;
	}
}

