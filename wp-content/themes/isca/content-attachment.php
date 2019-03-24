<?php
/**
 * Display an attachment
 *
 * @package Isca
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_title( '<h1 class="pagetitle">', '</h1>' ); ?>
	<div class="entry">
<?php
	if ( $post->post_parent ) {
		$metadata = wp_get_attachment_metadata();
		printf( __( '<p class="postmetadata">Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a></p>', 'isca' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height'],
			esc_url( get_permalink( $post->post_parent ) ),
			esc_attr( strip_tags( get_the_title( $post->post_parent ) ) )
		);
	}

	echo '<div class="attachment-image">';
	echo wp_get_attachment_link( $post->ID, array( 1000, 1000 ) );
	echo '</div>';

	if ( has_excerpt() ) {
?>
		<div class="entry-caption">
			<?php the_excerpt(); ?>
		</div>
<?php
	}

	if ( $post->post_parent ) {
?>
        <p><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rev="attachment"><?php _e( '&laquo;Back', 'isca' ); ?></a></p>
<?php
	}
?>
	</div>
</article>
