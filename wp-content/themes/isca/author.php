<?php
/**
 * Display author posts and author information
 *
 * @package Isca
 */

	get_header();
	$user_id = (int) get_query_var( 'author' );

?>
		<h1 class="pagetitle">
			<?php esc_html_e( 'Author Archives', 'isca' ); ?>
		</h1>

		<div id="writer">
<?php
	echo get_avatar( get_the_author_meta( 'user_email', $user_id ), '80' );
?>
	<h3><?php the_author_meta( 'display_name', $user_id ); ?></h3>
<?php
	the_author_meta( 'description', $user_id );
?>
		</div>
<?php
	if ( have_posts() ) {
		echo '<ul id="recent-excerpts">';
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}
		echo '</ul>';

		the_posts_pagination(
			array(
				'mid_size' => 2,
				'next_text' => esc_html__( 'Older &rsaquo;', 'isca' ),
				'prev_text' => esc_html__( '&lsaquo; Newer', 'isca' ),
			)
		);
	}

	get_footer();
