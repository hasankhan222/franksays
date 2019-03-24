<?php
/**
 * Display the Gallery post format
 *
 * @package Isca
 */
?>
<div class="entry">
	<h2 class="posttitle">
		<a class="dark" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink for: %s', 'isca' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a>
	</h2>
<?php
	the_content( __( 'Continue &rarr;', 'isca' ) );
?>
</div>
