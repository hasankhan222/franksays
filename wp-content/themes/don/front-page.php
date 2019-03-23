<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.31
 */

get_header();

// If front-page is a static page
if (get_option('show_on_front') == 'page') {

	// If Front Page Builder is enabled - display sections
	if (eject_is_on(eject_get_theme_option('front_page_enabled'))) {

		if ( have_posts() ) the_post();

		$eject_sections = eject_array_get_keys_by_value(eject_get_theme_option('front_page_sections'), 1, false);
		if (is_array($eject_sections)) {
			foreach ($eject_sections as $eject_section) {
				get_template_part("front-page/section", $eject_section);
			}
		}
	
	// Else - display native page content
	} else
		get_template_part('page');

// Else get index template to show posts
} else
	get_template_part('index');

get_footer();
?>