<?php
/**
 * Display the loop for generic pages
 *
 * @package Isca
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry">
<?php
		the_content( esc_html__( 'Continue &rarr;', 'isca' ) );

		wp_link_pages(
			array(
				'before' => '<p id="archive-pagination">',
			)
		);
?>
	</div>
</article>
