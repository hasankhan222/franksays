<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.10
 */

// Copyright area
$eject_footer_scheme =  eject_is_inherit(eject_get_theme_option('footer_scheme')) ? eject_get_theme_option('color_scheme') : eject_get_theme_option('footer_scheme');
$eject_copyright_scheme = eject_is_inherit(eject_get_theme_option('footer_scheme')) ? $eject_footer_scheme : eject_get_theme_option('footer_scheme');
$eject_footer_wide = eject_get_theme_option('footer_wide');
?>
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($eject_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap<?php echo !empty($eject_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$eject_copyright = eject_prepare_macros(eject_get_theme_option('copyright'));
				if (!empty($eject_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $eject_copyright, $eject_matches)) {
						$eject_copyright = str_replace($eject_matches[1], date(str_replace(array('{', '}'), '', $eject_matches[1])), $eject_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($eject_copyright));
				}
			?></div>
			<?php
			// Socials
			if ( eject_is_on(eject_get_theme_option('socials_in_footer')) && ($eject_output = eject_get_socials_links()) != '') {
			?>
			<div class="socials_wrap_footer">
					<?php eject_show_layout($eject_output); ?>
			</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
