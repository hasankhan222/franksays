<?php
/**
 * Search results
 *
 * @package Isca
 */

	get_header();

?>
	<h1 class="pagetitle">
		<?php printf( __( 'Search results for <em>&#8216;%s&#8217;</em>', 'isca' ), get_search_query() ); ?>
	</h1>
<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content-loop' );
		}

		the_posts_pagination(
			array(
				'mid_size' => 2,
				'next_text' => esc_html__( 'Older &rsaquo;', 'isca' ),
				'prev_text' => esc_html__( '&lsaquo; Newer', 'isca' ),
			)
		);

	} else {
?>
	<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'isca' ); ?></p>
<?php
	}

	get_footer();
