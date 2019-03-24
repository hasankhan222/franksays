<?php
/**
 * Template Name: Full Width
 * Full width custom page template
 *
 * @package Isca
 */

	get_header();

	while ( have_posts() ) {
		the_post();
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="pagetitle">
					<?php the_title(); ?> <?php edit_post_link( __( 'Edit', 'isca' ), '', '' ); ?>
				</h1>
				<section class="entry">
<?php
		the_content();

		wp_link_pages( array(
			'before' => '<p id="archive-pagination">',
		));
?>
				</section>
			</article>
<?php
		comments_template( '', true );
	}

	get_footer();