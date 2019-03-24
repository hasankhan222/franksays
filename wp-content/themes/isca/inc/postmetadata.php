<?php
/**
 * Display data relevant to blog posts
 *
 * @package Isca
 */
?>
<div class="postmetadata">
<?php
	if ( get_post_format() ) {
?>
	<a href="<?php echo get_post_format_link( get_post_format() ); ?>" class="post_format_type"><?php echo get_post_format(); ?></a>
<?php
	} else {
		echo '<span class="post_format_type"></span>';
	}

	printf( __( '<a href="%1$s" class="permalink entry-date" rel="bookmark"><time datetime="%3$s">%4$s</time></a>', 'isca' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'isca' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);

	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
?>
<div class="commentcount"><?php comments_popup_link( __( 'Leave a comment', 'isca'), __( '1 Comment', 'isca' ), __( '% Comments', 'isca' ) ); ?></div>
<?php
	}
?>
<a href="<?php the_permalink(); ?>" class="permalink" rel="bookmark">&infin;</a>
</div>

