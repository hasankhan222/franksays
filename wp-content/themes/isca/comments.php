<?php
/**
 * Comments template.
 *
 * @package Isca
 */

if ( post_password_required() ) {
	return;
}

// Show the comments
if ( have_comments() ) {
?>
	<h3 id="comments">
<?php
		printf( _n( '1 reply', '%1$s replies', get_comments_number(), 'isca' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
?>
		<a href="#respond" title="<?php esc_attr_e( 'Leave a comment', 'isca' ); ?>"><?php _e( '&rsaquo;', 'isca' ); ?></a>
	</h3>
	<ol class="commentlist" id="singlecomments">
		<?php wp_list_comments( 'type=comment&callback=isca_comment' ); ?>
	</ol>
	<div id="pagination">
		<div class="older">
			<?php previous_comments_link( __( '&lsaquo; Older Comments', 'isca' ) ); ?>
		</div>
		<div class="newer">
			<?php next_comments_link( __( 'Newer Comments &rsaquo;', 'isca' ) ); ?>
		</div>
	</div>
	<?php
}

if ( ! empty( $comments_by_type['pings'] ) ) {
?>
		<h3 id="trackbacks"><?php _e( 'Trackbacks', 'isca' ); ?></h3>
		<ol id="trackbacklist">
<?php
	foreach ( $comments_by_type['pings'] as $comment ) {
?>
					<li id="comment-<?php comment_ID(); ?>">
						<cite><?php comment_author_link(); ?></cite>
					</li>
<?php
	}
?>
		</ol>
<?php
}

comment_form();
