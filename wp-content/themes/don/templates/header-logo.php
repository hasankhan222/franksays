<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

$eject_args = get_query_var('eject_logo_args');

// Site logo
$eject_logo_image  = eject_get_logo_image(isset($eject_args['type']) ? $eject_args['type'] : '');
$eject_logo_text   = eject_is_on(eject_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$eject_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($eject_logo_image) || !empty($eject_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($eject_logo_image)) {
			$eject_attr = eject_getimagesize($eject_logo_image);
			echo '<img src="'.esc_url($eject_logo_image).'" alt="'.esc_attr__('img', 'eject').'"'.(!empty($eject_attr[3]) ? sprintf(' %s', $eject_attr[3]) : '').'>';
		} else {
			eject_show_layout(eject_prepare_macros($eject_logo_text), '<span class="logo_text">', '</span>');
			eject_show_layout(eject_prepare_macros($eject_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>