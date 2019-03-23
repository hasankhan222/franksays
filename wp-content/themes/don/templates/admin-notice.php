<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.1
 */
 
$eject_theme_obj = wp_get_theme();
?>
<div class="update-nag" id="eject_admin_notice">
	<h3 class="eject_notice_title"><?php echo sprintf(esc_html__('Welcome to %s v.%s', 'eject'), $eject_theme_obj->name.(EJECT_THEME_FREE ? ' '.esc_html__('Free', 'eject') : ''), $eject_theme_obj->version); ?></h3>
	<?php
	if (!eject_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'eject')); ?></p><?php
	}
	?><p>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=eject_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php echo sprintf(esc_html__('About %s', 'eject'), $eject_theme_obj->name); ?></a>
		<?php
		if (eject_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'eject'); ?></a>
			<?php
		}
		if (function_exists('eject_exists_trx_addons') && eject_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'eject'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'eject'); ?></a>
		<span> <?php esc_html_e('or', 'eject'); ?> </span>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'eject'); ?></a>
        <a href="#" class="button eject_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'eject'); ?></a>
	</p>
</div>