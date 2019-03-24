<?php
/**
 * Theme updater admin page and functions.
 *
 * @package isca
 */

/**
 * Load Getting Started styles in the admin
 * @return [type] [description]
 */
function isca_load_admin_scripts() {

	// Load styles only on our page.
	global $pagenow;

	if ( 'themes.php' !== $pagenow || isca_is_child_theme() ) {
		return false;
	}

	// Getting Started styles.
	wp_enqueue_style( 'isca-getting-started', get_template_directory_uri() . '/helpers/getting-started/getting-started.css', false, '1.0.0' );

}

add_action( 'admin_enqueue_scripts', 'isca_load_admin_scripts' );


/**
 * Adds a menu item for the Getting Started page
 */
function isca_getting_started_menu() {

	if ( isca_is_child_theme() ) {
		return false;
	}

	add_theme_page(
		esc_html__( 'Getting Started', 'isca' ),
		esc_html__( 'Getting Started', 'isca' ),
		'manage_options',
		'isca-getting-started',
		'isca_getting_started'
	);

}

add_action( 'admin_menu', 'isca_getting_started_menu' );


/**
 * Outputs the getting started page.
 */
function isca_getting_started() {

	// Theme info.
	$theme = wp_get_theme();
	$theme_name = $theme->get( 'Name' );
	$theme_description = $theme->get( 'Description' );
	$theme_slug = basename( get_stylesheet_directory() );
	$theme_user = wp_get_current_user();

?>

		<div class="wrap getting-started about-wrap">

			<h1><?php printf( esc_html__( 'Getting started with %s', 'isca' ), esc_html( $theme_name ) ); ?></h1>

			<div class="about-text"><?php printf( esc_html__( 'Hi %s, thank you for installing %s! %s', 'isca' ), esc_html( $theme_user->display_name ), esc_html( $theme_name ), esc_html( $theme_description ) ); ?></div>

			<div class="panels">

<?php
	include( 'parts/help.php' );
	include( 'parts/plugins.php' );
	include( 'parts/changelog.php' );
?>

			</div>

		</div>

<?php

}
