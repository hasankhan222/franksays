<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.10
 */

$eject_footer_scheme =  eject_is_inherit(eject_get_theme_option('footer_scheme')) ? eject_get_theme_option('color_scheme') : eject_get_theme_option('footer_scheme');
?>
<footer class="footer_wrap footer_default scheme_<?php echo esc_attr($eject_footer_scheme); ?>">
	<?php

	// Footer widgets area
	get_template_part( 'templates/footer-widgets' );

	// Copyright area
	get_template_part( 'templates/footer-copyright' );
	
	?>
</footer><!-- /.footer_wrap -->
