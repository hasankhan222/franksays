<?php
/**
 * Display the loop for Home
 *
 * @package Isca
 */
?>
<div class="entry">
<?php
	if ( is_single() ) {

		the_content();

	} else {

?>
	<h2 class="posttitle">
		<a class="dark" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __('Permalink for: %s', 'isca' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a>
	</h2>
<?php

		if ( get_the_post_thumbnail( get_the_ID(), 'isca-archive' ) ) {
			echo '<a href="' . esc_url( get_permalink() ) . '" class="thumbnail">';
			the_post_thumbnail( 'isca-archive' );
			echo '</a>';
		}

		the_excerpt();

?>
	<p>
		<a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark"><?php _e( 'Continue Reading &rarr;', 'isca' ); ?></a>
	</p>
<?php

	}
?>
</div>
