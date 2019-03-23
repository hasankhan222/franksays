<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('eject_mailchimp_get_css')) {
	add_filter('eject_filter_get_css', 'eject_mailchimp_get_css', 10, 4);
	function eject_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = eject_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {

}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {}
.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.mc4wp-form .mc4wp-alert a {
    color: {$colors['inverse_link']};
}
.mc4wp-form .mc4wp-alert a:hover {
    color: {$colors['inverse_text']};
}

CSS;
		}

		return $css;
	}
}
?>