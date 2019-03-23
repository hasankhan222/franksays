<?php
/**
 * The template to display the Structured Data Snippets
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.30
 */

// Structured data snippets
if (eject_is_on(eject_get_theme_option('seo_snippets'))) {
	?><div class="structured_data_snippets">
		<meta itemprop="headline" content="<?php echo esc_attr(get_the_title()); ?>">
		<meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
		<meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
		<div itemscope itemprop="publisher" itemtype="https://schema.org/Organization">
			<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
			<meta itemprop="telephone" content="">
			<meta itemprop="address" content="">
			<?php
			$eject_logo_image = eject_get_retina_multiplier() > 1 
								? eject_get_theme_option( 'logo_retina' )
								: eject_get_theme_option( 'logo' );
			if (!empty($eject_logo_image)) {
				?><meta itemprop="logo" itemtype="https://schema.org/logo" content="<?php echo esc_url($eject_logo_image); ?>"><?php
			}
			?>
		</div>
	</div>
	<?php
}
?>