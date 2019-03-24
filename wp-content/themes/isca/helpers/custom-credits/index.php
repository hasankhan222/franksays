<?php
/**
 * Allow users to edit footer credits.
 *
 * @package isca
 */

/**
 * Theme Credits Customizer properties
 *
 * @param WP_Customize_Manager $wp_customize WP Customize object. Passed by WordPress.
 */
function isca_customizer_credits( WP_Customize_Manager $wp_customize ) {

	if ( ! current_theme_supports( 'isca-custom-credits' ) ) {
		return;
	}

	/**
	 * Isca theme options section.
	 */
	$wp_customize->add_section(
		'isca_credits',
		array(
			'title' => esc_html__( 'Footer Credits', 'isca' ),
		)
	);

	/**
	 * Setting to allow the credits to be hidden.
	 */
	$wp_customize->add_setting(
		'isca_display_credits',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'isca_credits_sanitize_checkbox',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'isca_display_credits',
		array(
			'label' => esc_html__( 'Display Footer Credits', 'isca' ),
			'section' => 'isca_credits',
			'type' => 'checkbox',
		)
	);

	/**
	 * Setting to allow the credits to be hidden.
	 */
	$wp_customize->add_setting(
		'isca_credits_content',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'isca_credits_content',
		array(
			'label' => esc_html__( 'Credits Content', 'isca' ),
			'section' => 'isca_credits',
			'type' => 'textarea',
		)
	);

}

add_action( 'customize_register', 'isca_customizer_credits' );



/**
 * Update Credits without doing a full page refresh.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function isca_register_customize_refresh_credits( WP_Customize_Manager $wp_customize ) {

	if ( ! current_theme_supports( 'isca-custom-credits' ) ) {
		return;
	}

	// Ensure selective refresh is enabled.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		return false;

	}

	// Update credits content.
	$wp_customize->selective_refresh->add_partial(
		'isca_credits_content',
		array(
			'selector' => 'section.footer-wrap',
			'render_callback' => function() {
				isca_credits_content( false );
			},
		)
	);

}

add_action( 'customize_register', 'isca_register_customize_refresh_credits' );


/**
 * Display credits content.
 *
 * @param  boolean $wrapper True to display wrapper, false for just contents.
 * @return boolean
 */
function isca_credits_content( $wrapper = true ) {

	$contents = isca_credits_get_content();

	if ( $contents && $wrapper ) {

		$args = get_theme_support( 'isca-custom-credits' )[0];

		echo $args['before'] . $contents . $args['after']; // WPCS: XSS ok.

	}

	if ( $contents && ! $wrapper ) {

		echo $contents; // WPCS: XSS ok.

	}

	// False to display defaults credits.
	// True to display credits as above.
	return ! empty( $contents );

}


/**
 * Display credits content.
 */
function isca_credits_get_content() {

	$contents = get_theme_mod( 'isca_credits_content', '' );

	$contents = str_replace( '[[YEAR]]', date( 'Y' ), $contents );

	return wp_kses_post( $contents );

}


/**
 * Setup theme properties related to footer credits.
 */
function isca_credits_after_setup_theme() {

	// If the theme doesn't support custom credits return false.
	// False means the default credits will display.
	if ( ! current_theme_supports( 'isca-custom-credits' ) ) {
		return;
	}

	$args = get_theme_support( 'isca-custom-credits' )[0];

	add_filter( $args['credits_filter'], 'isca_credits_footer' );

}

add_action( 'after_setup_theme', 'isca_credits_after_setup_theme', 11 );


/**
 * Display footer credits.
 * @return [type] [description]
 */
function isca_credits_footer() {

	// If the theme doesn't support custom credits return false.
	// False means the default credits will display.
	if ( ! current_theme_supports( 'isca-custom-credits' ) ) {
		return false;
	}

	// If we're omt in the customizer preview and credits have been disabled
	// then lets quit.
	// Return true so that the credits get hidden.
	if ( ! is_customize_preview() && ! get_theme_mod( 'isca_display_credits', true ) ) {
		return true;
	}

	return isca_credits_content();

}


/**
 * Sanitize checkbox input.
 *
 * @param  null|boolean $input Checkbox value to check.
 * @return boolean
 */
function isca_credits_sanitize_checkbox( $input = null ) {

	return (bool) $input;

}


/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function isca_credits_customize_preview_js() {

	wp_enqueue_script( 'isca-credits-customize-preview', get_theme_file_uri( '/helpers/custom-credits/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );

	isca_credits_customizer_vars( 'isca-credits-customize-preview' );

}

add_action( 'customize_preview_init', 'isca_credits_customize_preview_js' );


/**
 * Load dynamic logic for the customizer controls area.
 */
function isca_credits_panels_js() {

	wp_enqueue_script( 'isca-credits-panels', get_theme_file_uri( '/helpers/custom-credits/customize-controls.js' ), array(), '1.0', true );

	isca_credits_customizer_vars( 'isca-credits-panels' );

}

add_action( 'customize_controls_enqueue_scripts', 'isca_credits_panels_js' );


/**
 * Setup javascript variables for customizer usage.
 * Allows us to keep the functions generic for usage across multiple themes.
 *
 * @param  string $slug The slug used to identify the javascript file.
 */
function isca_credits_customizer_vars( $slug ) {

	$args = get_theme_support( 'isca-custom-credits' )[0];

	// Localized Javascript strings and provide access to common properties.
	wp_localize_script(
		$slug,
		'isca_credits_global',
		$args
	);

}
