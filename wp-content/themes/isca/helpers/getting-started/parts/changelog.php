<?php
/**
 * Display the themes changes.
 *
 * @package isca
 */

	$file = get_template_directory() . '/changelog.txt';
?>
<div class="feature-section one-col">

    <h2><?php esc_html_e( 'Theme Changes', 'isca' ); ?></h2>

<?php
	if ( file_exists( $file ) ) {

		include( $file );

	}
?>

</div>

<hr />
