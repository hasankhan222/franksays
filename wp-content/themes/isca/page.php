<?php
/**
 * Static page layout
 *
 * @package Isca
 */

	get_header();
?>
	<h1 class="pagetitle">
		<?php the_title(); ?> <?php edit_post_link( __( 'Edit', 'isca' ), '', '' ); ?>
	</h1>
<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', 'page' );
		comments_template( '', true );
	}

	get_footer();