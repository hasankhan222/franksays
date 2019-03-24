<?php
/**
 * Search form
 *
 * @package Isca
 */

?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="searchfield" placeholder="<?php esc_attr_e( 'Search...', 'isca' ); ?>" /><input type="image"
	src="<?php echo esc_url( get_template_directory_uri() . '/images/magnify@2x.png' ); ?>" width="14" height="14" class="searchsubmit" />
</form>
