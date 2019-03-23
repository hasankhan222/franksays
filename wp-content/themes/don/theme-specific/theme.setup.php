<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.22
 */

if (!defined("EJECT_THEME_FREE")) define("EJECT_THEME_FREE", false);

// Theme storage
$EJECT_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'eject'),
			
			// Recommended (supported) plugins
			// If plugin not need - comment (or remove) it
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'eject')
		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		EJECT_THEME_FREE ? array() : array(

			// Recommended (supported) plugins
			// If plugin not need - comment (or remove) it
			'js_composer'					=> esc_html__('Visual Composer', 'eject'),
			'vc-extensions-bundle'			=> esc_html__('Visual Composer extensions bundle', 'eject'),
			'essential-grid'				=> esc_html__('Essential Grid', 'eject'),
			'revslider'						=> esc_html__('Revolution Slider', 'eject'),
			'gdpr-framework'				=> esc_html__('GDPR Framework', 'eject')
		)
	),
	
	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url' => 'http://eject.themerex.net',
	'theme_doc_url' => 'http://eject.themerex.net/doc',
	'theme_support_url' => 'https://themerex.ticksy.com',
	'theme_download_url' => 'https://themeforest.net/user/themerex/portfolio'
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('eject_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'eject_customizer_theme_setup1', 1 );
	function eject_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		eject_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false,		// Allow upload not pre-packaged plugins via TGMPA
			
			'allow_theme_layouts'	=> true		// Include theme's default headers and footers to the list after custom layouts
													// or leave in the list only custom layouts
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		eject_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Roboto',
				'family' => 'sans-serif',
				'styles' => '300,300italic,400,400italic,500,500italic,700,700italic'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'	 => 'Roboto Condensed',
				'family' => 'sans-serif',
				'styles' => '300,300italic,400,400italic,700,700italic'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'	 => 'Lora',
				'family' => 'serif',
				'styles' => '400,400italic,700,700italic'		// Parameter 'style' used only for the Google fonts
			),
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		eject_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		eject_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'eject'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'eject'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.69em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.82em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '3.125em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.06em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1px',
				'margin-top'		=> '1.18em',
				'margin-bottom'		=> '0.5em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '2.375em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.06em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.8px',
				'margin-top'		=> '1.6em',
				'margin-bottom'		=> '0.68em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '1.875em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.09em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.6px',
				'margin-top'		=> '2.1em',
				'margin-bottom'		=> '0.85em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '1.5em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.41em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.48px',
				'margin-top'		=> '2.48em',
				'margin-bottom'		=> '0.6em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '1.313em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.35em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.41px',
				'margin-top'		=> '2.93em',
				'margin-bottom'		=> '0.75em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.4706em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.32px',
				'margin-top'		=> '3.8em',
				'margin-bottom'		=> '1em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'eject'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'eject'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'eject'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'eject'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'eject'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'eject'),
				'description'		=> esc_html__('Font settings of the main menu items', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '2px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'eject'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'eject'),
				'font-family'		=> '"Roboto Condensed",sans-serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '2.4px'
				),
			'other' => array(
				'title'				=> esc_html__('Other', 'eject'),
				'description'		=> esc_html__('Font settings of the other items', 'eject'),
				'font-family'		=> '"Lora",serif'
			)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		eject_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'eject'),
							'description'	=> __('Colors of the main content area', 'eject')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'eject'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'eject')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'eject'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'eject')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'eject'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'eject')
							),
			'input'	=> array(
							'title'			=> __('Input', 'eject'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'eject')
							),
			)
		);
		eject_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'eject'),
							'description'	=> __('Background color of this block in the normal state', 'eject')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'eject'),
							'description'	=> __('Background color of this block in the hovered state', 'eject')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'eject'),
							'description'	=> __('Border color of this block in the normal state', 'eject')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'eject'),
							'description'	=> __('Border color of this block in the hovered state', 'eject')
							),
			'text'		=> array(
							'title'			=> __('Text', 'eject'),
							'description'	=> __('Color of the plain text inside this block', 'eject')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'eject'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'eject')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'eject'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'eject')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'eject'),
							'description'	=> __('Color of the links inside this block', 'eject')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'eject'),
							'description'	=> __('Color of the hovered state of links inside this block', 'eject')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'eject'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'eject')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'eject'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'eject')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'eject'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'eject')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'eject'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'eject')
							)
			)
		);
		eject_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'eject'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#eaeaeb', //ok
		
					// Text and links colors
					'text'				=> '#7f7f7f', //ok
					'text_light'		=> '#adadad', //ok
					'text_dark'			=> '#1f1f1f', //ok
					'text_link'			=> '#45ba8d', //ok
					'text_hover'		=> '#1f1f1f', //ok
					'text_link2'		=> '#fc6a55', //ok
					'text_hover2'		=> '#f25c46', //ok
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#fafafa', //ok
					'alter_bg_hover'	=> '#f5f5f5', //ok
					'alter_bd_color'	=> '#e8e8e9', //ok
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#333333',
					'alter_light'		=> '#888888', //ok
					'alter_dark'		=> '#363636', //ok
					'alter_link'		=> '#fc6a55', //ok
					'alter_hover'		=> '#45ba8d',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1f1f1f', //ok
					'extra_bg_hover'	=> '#222333', //ok
					'extra_bd_color'	=> '#454545', //ok
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#d5d5d5', //ok
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#ffffff', //ok
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#fc6a55', //ok ?
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#ffffff',
					'input_bg_hover'	=> '#ffffff',
					'input_bd_color'	=> '#f0f0f0', //ok
					'input_bd_hover'	=> '#f0f0f0', //ok
					'input_text'		=> '#888888', //ok
					'input_light'		=> '#888888', //ok
					'input_dark'		=> '#888888', //ok
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'eject'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#161721', //ok
					'bd_color'			=> '#1c1b1f',
		
					// Text and links colors
					'text'				=> '#8d8f98', //ok
					'text_light'		=> '#8d8f98', //ok
					'text_dark'			=> '#ffffff', //ok
					'text_link'			=> '#45ba8d', //ok
					'text_hover'		=> '#ffffff', //ok ?
					'text_link2'		=> '#fc6a55', //ok
					'text_hover2'		=> '#f25c46', //ok
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#0f1017', //ok
					'alter_bg_hover'	=> '#28272e',
					'alter_bd_color'	=> '#313131',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#fc6a55', //ok
					'alter_hover'		=> '#fc6a55', //ok
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#222333', //ok
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#d5d5d5', //ok
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#ffaa5f',
					'extra_hover'		=> '#fc6a55', //ok ?
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#1c202a',
					'input_bg_hover'	=> '#1c202a',
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
		
		// Simple schemes substitution
		eject_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('eject_customizer_add_theme_colors')) {
	function eject_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = eject_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = eject_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = eject_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = eject_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = eject_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = eject_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = eject_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = eject_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = eject_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = eject_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_dark_07']  = eject_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = eject_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = eject_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = eject_hsb2hex(eject_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = eject_hsb2hex(eject_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('eject_customizer_add_theme_fonts')) {
	function eject_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			//$rez[$tag] = $font;
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !eject_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !eject_is_inherit($font['font-size'])
														? 'font-size:' . eject_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !eject_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !eject_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !eject_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !eject_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !eject_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !eject_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !eject_is_inherit($font['margin-top'])
														? 'margin-top:' . eject_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !eject_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . eject_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}




//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('eject_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'eject_customizer_theme_setup' );
	function eject_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('eject_filter_add_thumb_sizes', array(
			'eject-thumb-huge'		=> array(1170, 658, true),
			'eject-thumb-big' 		=> array( 760, 428, true),
			'eject-thumb-med' 		=> array( 370, 208, true),
			'eject-thumb-tiny' 		=> array(  90,  90, true),
			'eject-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'eject-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			'eject-thumb-extra'		=> array( 775, 864, true),
			'eject-thumb-blogger'		=> array( 770, 652, true),
			)
		);
		$mult = eject_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'eject_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('eject_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'eject_customizer_image_sizes' );
	function eject_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('eject_filter_add_thumb_sizes', array(
			'eject-thumb-huge'		=> esc_html__( 'Huge image', 'eject' ),
			'eject-thumb-big'			=> esc_html__( 'Large image', 'eject' ),
			'eject-thumb-med'			=> esc_html__( 'Medium image', 'eject' ),
			'eject-thumb-tiny'		=> esc_html__( 'Small square avatar', 'eject' ),
			'eject-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'eject' ),
			'eject-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'eject' ),
			'eject-thumb-extra'		=> esc_html__( 'Extra', 'eject' ),
			'eject-thumb-blogger'		=> esc_html__( 'Blogger', 'eject' ),
			)
		);
		$mult = eject_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'eject' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'eject_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'eject_customizer_trx_addons_add_thumb_sizes');
	function eject_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								'trx_addons-thumb-extra',
								'trx_addons-thumb-blogger',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'eject_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'eject_customizer_trx_addons_get_thumb_size');
	function eject_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							'trx_addons-thumb-extra',
							'trx_addons-thumb-extra-@retina',
							'trx_addons-thumb-blogger',
							'trx_addons-thumb-blogger-@retina',
							),
							array(
							'eject-thumb-huge',
							'eject-thumb-huge-@retina',
							'eject-thumb-big',
							'eject-thumb-big-@retina',
							'eject-thumb-med',
							'eject-thumb-med-@retina',
							'eject-thumb-tiny',
							'eject-thumb-tiny-@retina',
							'eject-thumb-masonry-big',
							'eject-thumb-masonry-big-@retina',
							'eject-thumb-masonry',
							'eject-thumb-masonry-@retina',
							'eject-thumb-extra',
							'eject-thumb-extra-@retina',
							'eject-thumb-blogger',
							'eject-thumb-blogger-@retina',
							),
							$thumb_size);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'eject_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'eject_importer_set_options', 9 );
	function eject_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(eject_get_protocol() . '://demofiles.themerex.net/eject/');
			// Required plugins
			$options['required_plugins'] = array_keys(eject_storage_get('required_plugins'));
			// Default demo
			$options['files']['default']['title'] = esc_html__('BaseKit Demo', 'eject');
			$options['files']['default']['domain_dev'] = '';		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(eject_get_protocol().'://eject.themerex.net');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'eject');
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('eject_create_theme_options')) {

	function eject_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'eject');

		eject_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'eject'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'eject'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'eject'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'eject') ),
				"class" => "eject_column-1_2 eject_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'eject'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'eject') ),
				"class" => "eject_column-1_2",
				"refresh" => false,
				"std" => 0,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'eject'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'eject') ),
				"class" => "eject_column-1_2 eject_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'eject'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'eject') ),
				"class" => "eject_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => EJECT_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'eject'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'eject') ),
				"class" => "eject_column-1_2 eject_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'eject'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'eject') ),
				"class" => "eject_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => EJECT_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'eject'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'eject') ),
				"class" => "eject_column-1_2 eject_new_row",
				"std" => '',
				"type" => "hidden"
				//"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'eject'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'eject') ),
				"class" => "eject_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => "hidden"
				//"type" => EJECT_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'eject'),
				"desc" => wp_kses_data( __('Settings for the entire site', 'eject') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'eject'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'eject'),
				"desc" => wp_kses_data( __('Select width of the body content', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'eject')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'eject'),
					'wide'		=> esc_html__('Wide',		'eject'),
					'wide extra'=> esc_html__('Wide Extra',	'eject'),
					'fullwide'	=> esc_html__('Fullwide',	'eject'),
					'fullscreen'=> esc_html__('Fullscreen',	'eject')
				),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'eject'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'eject') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'eject')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'eject'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'eject')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'eject'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'eject'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'eject')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'eject'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'eject')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'eject'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'eject') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'eject'),
				"desc" => '',
				"type" => EJECT_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'eject'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'eject')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => EJECT_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'eject'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'eject')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => EJECT_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'eject'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'eject')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => EJECT_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'eject'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'eject')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => EJECT_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'eject'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'eject'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'eject') ),
				"std" => 0,
				"type" => "hidden"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'eject'),
				"desc" => '',
				"type" => EJECT_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'eject'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'eject') ),
				"std" => 0,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),

            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'eject'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'eject') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'eject') ),
                "type"  => "text"
            ),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'eject'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'eject'),
				"desc" => '',
				"type" => "info"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'eject'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"std" => EJECT_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'eject'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"std" => 'default',
				"options" => array(),
				"type" => EJECT_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'eject'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"std" => 0,
				"type" => "hidden"
				//"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'eject'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'eject'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'eject') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'eject'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'eject') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'eject'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => eject_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'eject'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'eject') ),
				"type" => EJECT_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'eject'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'eject'),
					//'left'	=> esc_html__('Left',	'eject'),
					//'right'	=> esc_html__('Right',	'eject')
				),
				"type" => EJECT_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'eject'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'eject'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'eject')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'eject'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'eject') ),
				"std" => 1,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'eject'),
				"desc" => '',
				"type" => EJECT_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'eject'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'eject') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'eject')
				),
				"std" => 0,
				"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'eject'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number in the site footer', 'eject') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'eject'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'eject')
				),
				"std" => EJECT_THEME_FREE ? 'footer-custom-sow-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'eject'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'eject')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'eject'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'eject')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => eject_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'eject'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'eject') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'eject')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'eject'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'eject') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'eject'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'eject') ),
				"std" => esc_html__('ThemeREX &copy; {Y}. All rights reserved. Terms of use and Privacy Policy', 'eject'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'eject'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'eject') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'eject'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'eject') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'eject'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'eject'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'eject'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'eject'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'eject') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'eject'),
						'fullpost'	=> esc_html__('Full post',	'eject')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'eject'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'eject') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 30,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'eject'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'eject') ),
					"std" => 2,
					"options" => eject_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'eject'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'eject'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'eject'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'eject'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"std" => "pages",
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'eject'),
						'links'	=> esc_html__("Older/Newest", 'eject'),
						'more'	=> esc_html__("Load more", 'eject'),
						'infinite' => esc_html__("Infinite scroll", 'eject')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'eject'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'eject'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'eject'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'eject') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'eject'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'eject') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'eject'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'eject') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'eject'),
					"desc" => '',
					"type" => EJECT_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'eject'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'eject') ),
					"std" => 'hide',
					"options" => array(),
					"type" => EJECT_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'eject'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'eject') ),
					"std" => 'hide',
					"options" => array(),
					"type" => EJECT_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'eject'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'eject') ),
					"std" => 'hide',
					"options" => array(),
					"type" => EJECT_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'eject'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'eject') ),
					"std" => 'hide',
					"options" => array(),
					"type" => EJECT_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'eject'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'eject'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'eject') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'eject'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'eject') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'eject'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'eject') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'eject'),
						'columns' => esc_html__('Mini-cards',	'eject')
					),
					"type" => EJECT_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'eject'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => "none",
					"options" => array(),
					"type" => EJECT_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'eject'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'eject') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'eject'),
						'date'		 => esc_html__('Post date', 'eject'),
						'author'	 => esc_html__('Post author', 'eject'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'eject'),
						'share'		 => esc_html__('Share links', 'eject'),
						'edit'		 => esc_html__('Edit link', 'eject')
					),
					"type" => EJECT_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'eject'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'eject') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'eject')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'eject'),
						'likes' => esc_html__('Likes', 'eject'),
						'comments' => esc_html__('Comments', 'eject')
					),
					"type" => EJECT_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'eject'),
					"desc" => wp_kses_data( __('Settings of the single post', 'eject') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'eject'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'eject') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'eject')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'eject'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'eject') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'eject'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'eject') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'eject'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'eject') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'eject'),
						'date'		 => esc_html__('Post date', 'eject'),
						'author'	 => esc_html__('Post author', 'eject'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'eject'),
						'share'		 => esc_html__('Share links', 'eject'),
						'edit'		 => esc_html__('Edit link', 'eject')
					),
					"type" => EJECT_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'eject'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'eject') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'eject'),
						'likes' => esc_html__('Likes', 'eject'),
						'comments' => esc_html__('Comments', 'eject')
					),
					"type" => EJECT_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'eject'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'eject') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'eject'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'eject') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'eject'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'eject'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'eject') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'eject')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'eject'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'eject') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => eject_get_list_range(1,9),
					"type" => EJECT_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'eject'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'eject') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => eject_get_list_range(1,4),
					"type" => EJECT_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'eject'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'eject'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'eject') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'eject'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'eject')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'eject'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'eject')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'eject'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'eject')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'eject'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'eject')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => EJECT_THEME_FREE ? "hidden" : "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'eject'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'eject')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'eject'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'eject') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'eject'),
				"desc" => '',
				"std" => '$eject_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'eject'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'eject') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'eject')
				),
				"hidden" => true,
				"std" => '',
				"type" => EJECT_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'eject'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'eject') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'eject')
				),
				"hidden" => true,
				"std" => '',
				"type" => EJECT_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

			'last_option' => array(
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'eject'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'eject'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'eject') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'eject') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'eject'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'eject') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'eject') ),
				"class" => "eject_column-1_3 eject_new_row",
				"refresh" => false,
				"std" => '$eject_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=eject_get_theme_setting('max_load_fonts'); $i++) {
			if (eject_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					"title" => esc_html(sprintf(__('Font %s', 'eject'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'eject'),
				"desc" => '',
				"class" => "eject_column-1_3 eject_new_row",
				"refresh" => false,
				"std" => '$eject_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'eject'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'eject') )
							: '',
				"class" => "eject_column-1_3",
				"refresh" => false,
				"std" => '$eject_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'eject'),
					'serif' => esc_html__('serif', 'eject'),
					'sans-serif' => esc_html__('sans-serif', 'eject'),
					'monospace' => esc_html__('monospace', 'eject'),
					'cursive' => esc_html__('cursive', 'eject'),
					'fantasy' => esc_html__('fantasy', 'eject')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'eject'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'eject') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'eject') )
							: '',
				"class" => "eject_column-1_3",
				"refresh" => false,
				"std" => '$eject_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = eject_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'eject'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'eject'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'eject'),
						'100' => esc_html__('100 (Light)', 'eject'), 
						'200' => esc_html__('200 (Light)', 'eject'), 
						'300' => esc_html__('300 (Thin)',  'eject'),
						'400' => esc_html__('400 (Normal)', 'eject'),
						'500' => esc_html__('500 (Semibold)', 'eject'),
						'600' => esc_html__('600 (Semibold)', 'eject'),
						'700' => esc_html__('700 (Bold)', 'eject'),
						'800' => esc_html__('800 (Black)', 'eject'),
						'900' => esc_html__('900 (Black)', 'eject')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'eject'),
						'normal' => esc_html__('Normal', 'eject'), 
						'italic' => esc_html__('Italic', 'eject')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'eject'),
						'none' => esc_html__('None', 'eject'), 
						'underline' => esc_html__('Underline', 'eject'),
						'overline' => esc_html__('Overline', 'eject'),
						'line-through' => esc_html__('Line-through', 'eject')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'eject'),
						'none' => esc_html__('None', 'eject'), 
						'uppercase' => esc_html__('Uppercase', 'eject'),
						'lowercase' => esc_html__('Lowercase', 'eject'),
						'capitalize' => esc_html__('Capitalize', 'eject')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "eject_column-1_5",
					"refresh" => false,
					"std" => '$eject_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		eject_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			eject_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'eject'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'eject') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'eject')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('eject_options_get_list_cpt_options')) {
	function eject_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'eject'),
						"desc" => '',
						"type" => "info",
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Header style', 'eject'),
						"desc" => wp_kses_data( sprintf(__('Select style to display the site header on the %s pages', 'eject'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => EJECT_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'eject'),
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'eject'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => EJECT_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'eject'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'eject') ),
						"std" => 0,
						"type" => EJECT_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'eject'),
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'eject'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'eject'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'eject'),
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'eject'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'eject'),
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'eject'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'eject'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'eject') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'eject'),
						"desc" => '',
						"type" => "info",
						),
					'footer_style_{$cpt}' => array(
						"title" => esc_html__('Footer style', 'eject'),
						"desc" => wp_kses_data( __('Select style to display the site footer', 'eject') ),
						"std" => 'inherit',
						"options" => array(),
						"type" => EJECT_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'eject'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'eject') ),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'eject'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'eject') ),
						"dependency" => array(
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => eject_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'eject'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'eject') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'eject'),
						"desc" => '',
						"type" => EJECT_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'eject'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'eject') ),
						"std" => 'hide',
						"options" => array(),
						"type" => EJECT_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'eject'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'eject') ),
						"std" => 'hide',
						"options" => array(),
						"type" => EJECT_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'eject'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'eject') ),
						"std" => 'hide',
						"options" => array(),
						"type" => EJECT_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'eject'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'eject') ),
						"std" => 'hide',
						"options" => array(),
						"type" => EJECT_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('eject_options_get_list_choises')) {
	add_filter('eject_filter_options_get_list_choises', 'eject_options_get_list_choises', 10, 2);
	function eject_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = eject_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = eject_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = eject_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = eject_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = eject_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = eject_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = eject_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = eject_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = eject_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = eject_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = eject_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = eject_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = eject_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = eject_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = eject_array_merge(array(0 => esc_html__('- Select category -', 'eject')), eject_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = eject_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = eject_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = eject_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>