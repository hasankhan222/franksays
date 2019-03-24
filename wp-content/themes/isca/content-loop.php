<?php
/**
 * Display the loop for homepage and archives
 *
 * @package Isca
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cf">
		<div class="fourcol">
			<?php get_template_part( 'inc/postmetadata' ); ?>
		</div>
		<div class="eightcol">
			<?php get_template_part( 'content', get_post_format() ); ?>
		</div>
	</div>
</article>