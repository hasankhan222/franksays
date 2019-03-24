<?php
/**
 * Error - file not found
 *
 * @package Isca
 */

	get_header();
?>
	<article>
		<h1 class="pagetitle"><?php _e( 'Error 404', 'isca' ); ?></h1>
		<section id="error-msg">
			<h3><?php _e( 'Oops!', 'isca' ); ?></h3>
			<p><?php _e( 'Sorry, but the page you are looking for has not been found. Try checking the URL for errors, then hit the refresh button in your browser.', 'isca' ); ?></p>
		</section>
	</article>
<?php
	get_footer();
