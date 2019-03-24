<?php
/**
 * List content archive
 *
 * @package Isca
 */

get_header();

if ( have_posts() ) {

	the_archive_title( '<h1 class="pagetitle">', '</h1>' );

	the_archive_description( '<div class="category_description">', '</div>' );

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
	<h2><?php esc_html_e( 'Not Found', 'isca' ); ?></h2>
<?php
}

get_footer();
