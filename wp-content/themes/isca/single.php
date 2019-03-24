<?php
/**
 * Single blog post
 *
 * @package Isca
 */

	get_header();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry">
<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			the_content();

			wp_link_pages( array(
				'before' => '<p id="archive-pagination">',
				'after' => '</p>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			));

			get_template_part( 'inc/pagination' );

			// Categories.
			if ( 'post' === get_post_type() ) {
				echo '<p class="post-taxonomies">' . esc_html__( 'Categories: ', 'isca' );
				the_category( ', ' );
				echo '</p>';
			}

			// Tags.
			the_tags( '<p class="post-taxonomies">' . __( 'Tags: ', 'isca' ), ', ', '</p>' );

			// Comments.
			comments_template( '', true );
		}
	}
?>
	</div>
</article>
<?php
	get_footer();
