<?php
/**
 * Display the loop for Home
 *
 * @package Isca
 */
?>
<div class="entry">
	<?php the_content(); ?>
</div>
<?php
	if ( ! is_single() ) {
?>
<h2 class="posttitle">
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink for: %s', 'isca' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a>
</h2>
<?php
	}