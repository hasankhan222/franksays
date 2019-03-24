<?php
/**
 * Website header
 *
 * @package Isca
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script><![endif]-->
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<section class="container hfeed">
			<header id="masthead" role="banner">
				<?php do_action( 'before' ); ?>
				<nav class="menu" id="nav-primary">
					<section class="row clearfloat">
<?php
	$args = array(
		'theme_location' => 'navigation_top',
		'menu_id' => '',
		'menu_class' => 'nav',
		'fallback_cb' => 'isca_category_menu',
		'echo' => true,
	);

	wp_nav_menu( $args );
?>
					</section>
				</nav>

			</header>

			<div id="content" class="<?php echo isca_content_class(); ?>">
				<div class="wrapper" id="top">
					<div id="main">
						<?php isca_custom_header(); ?>
						<nav class="menu" id="nav-lower">
<?php
	$args = array(
		'theme_location' => 'navigation_bottom',
		'menu_id' => '',
		'menu_class' => 'nav',
		'fallback_cb' => 'isca_page_menu',
		'echo' => true,
	);

	$menu = wp_nav_menu( $args );
?>
						</nav>
						<hr class="nav-bot" />

<?php
	if ( is_single() ) {
?>
	<h1 class="posttitle">
		<?php the_title(); ?> <?php edit_post_link( __( 'Edit', 'isca' ), '', '' ); ?>
	</h1>
<?php

		get_template_part( 'inc/postmetadata' );
	}
?>
						<section class="<?php isca_row_class(); ?>" id="main-content">
