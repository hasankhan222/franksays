<?php
/**
 * Theme modification functions
 *
 * @package Isca
 */

require_once 'inc/jetpack.php';
require_once 'inc/woocommerce.php';


/**
 * Init scripts.
 */
function isca_scripts_init() {

	wp_enqueue_script( 'isca-script-elemental-components', get_template_directory_uri() . '/js/jquery.elemental.components.js', array( 'jquery', 'hoverIntent' ), '1.0', false );
	wp_enqueue_script( 'isca-script-responsive-navigation', get_template_directory_uri() . '/js/responsiveNavigation.js', array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'isca-script-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'masonry', 'isca-script-elemental-components', 'isca-script-responsive-navigation' ), '1.0', false );

	wp_enqueue_script( 'isca-html5shiv', get_template_directory_uri() . '/js/html5.js' );
	wp_script_add_data( 'isca-html5shiv', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script(
		'isca-script-main',
		'js_i18n',
		array(
			'menu' => esc_html__( 'Menu', 'isca' ),
		)
	);

}

add_action( 'wp_enqueue_scripts', 'isca_scripts_init' );


/**
 * Include custom stylesheets.
 */
function isca_styles_init() {

	wp_enqueue_style( 'isca-style-style', get_stylesheet_uri(), null, '1.0', 'all' );
	wp_enqueue_style( 'isca-style-nav', get_template_directory_uri() . '/css/nav.css', null, '1.0', 'all' );
	wp_enqueue_style( 'isca-style-1140', get_template_directory_uri() . '/css/1140.css', null, '1.0', 'all' );
	wp_enqueue_style( 'isca-style-ie', get_template_directory_uri() . '/css/ie.css', null, '1.0', 'all' );
	wp_enqueue_style( 'isca-style-print', get_template_directory_uri() . '/css/print.css', null, '1.0', 'print' );

	/* Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$lora = _x( 'on', 'Lora font: on or off', 'isca' );

	if ( 'off' !== $lora ) {
		wp_enqueue_style( 'isca-style-lora', 'https://fonts.googleapis.com/css?family=Lora', null, '1.0', 'all' );
	}

}

add_action( 'wp_enqueue_scripts', 'isca_styles_init' );


/**
 * Change heading color based upon custom header admin settings
 */
function isca_header_styles() {

?>
<style type="text/css">
	#branding h1#logo a,
	#branding h2#description {
		text-decoration:none;
		color:#<?php echo esc_attr( get_header_textcolor() ); ?>
	}
</style>
<?php

}


/**
 * Load stuff (custom theme support stuff)
 */
function isca_after_setup_theme() {

	// This sets the basename of the theme for localization.
	load_theme_textdomain( 'isca', get_template_directory() . '/languages' );

	// Title Tag.
	add_theme_support( 'title-tag' );

	// Feed me.
	add_theme_support( 'automatic-feed-links' );

	// Post thumbnails.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'isca-archive', 180, 120, true );

	// Custom headers.
	add_theme_support(
		'custom-header',
		array(
			'default-image' => '',
			'random-default' => false,
			'width' => 946,
			'height' => 150,
			'flex-height' => true,
			'header-text' => true,
			'default-text-color' => '282828',
			'uploads' => true,
			'wp-head-callback' => 'isca_header_styles',
		)
	);

	// Custom backgrounds.
	$args = array(
		'default-color' => 'e9e6e0',
	);
	add_theme_support( 'custom-background', $args );

	// Custom post formats.
	add_theme_support(
		'post-formats',
		array(
			'quote',
			'image',
			'video',
			'chat',
			'aside',
			'link',
			'gallery',
		)
	);

	// Custom nav.
	register_nav_menus(
		array(
			'navigation_top' => esc_html__( 'Main Navigation', 'isca' ),
			'navigation_bottom' => esc_html__( 'Sub Navigation', 'isca' ),
		)
	);
}

add_action( 'after_setup_theme', 'isca_after_setup_theme' );


/**
 * Init Widgets.
 */
function isca_widgets_init() {

	// Sidebar.
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar Widgets', 'isca' ),
			'id' => 'sidebar-1',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

	// Footer.
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Widgets', 'isca' ),
			'id' => 'sidebar-2',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		)
	);

}

add_action( 'widgets_init', 'isca_widgets_init' );


/**
 * Display the custom header graphic if it's switched on
 * in a separate function so that it can be reused in the custom header admin preview :)
 */
function isca_custom_header() {

	if ( 'blank' !== get_header_textcolor() ) {
?>
		<div id="branding" class="displaying-header-text">
			<h1 id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'isca' ); ?>" id="name"><?php bloginfo( 'name' ); ?></a>
			</h1>
			<?php if ( get_bloginfo( 'description' ) ) { ?>
			<h2 id="description">
				<?php bloginfo( 'description' ); ?>
			</h2>
			<?php } ?>
		</div>
<?php
	}

	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="header-image">
			<img src="<?php header_image(); ?>" alt="" />
		</a>
<?php
	}

}


/**
 * Custom header function that displays content for use in the admin preview
 */
function isca_custom_header_admin() {

?>
		<header id="branding" class="displaying-header-text">
			<h1 id="logo">
				<span id="name"><?php bloginfo( 'name' ); ?></span>
			</h1>
			<?php if ( get_bloginfo( 'description' ) ) { ?>
			<h2 id="description">
				<?php bloginfo( 'description' ); ?>
			</h2>
			<?php } ?>
		</header>

<?php
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
?>
		<span id="header-image">
			<img src="<?php header_image(); ?>" alt="" />
		</span>
<?php
	}

}


/**
 * Fallback menu for category menu (Top menu).
 */
function isca_category_menu() {

	$args = array(
		'title_li' => '',
		'orderby' => 'count',
		'order' => 'DESC',
		'number' => 7,
		'depth' => 2,
	);
?>
	<ul id="nav" class="nav">
		<?php wp_list_categories( $args ); ?>
	</ul>
<?php

}


/**
 * Fallback menu for page menu (Bottom menu).
 */
function isca_page_menu() {

	$args = array(
		'title_li' => '',
		'number' => 7,
		'depth' => 2,
	);
?>
	<ul id="nav" class="nav">
		<?php wp_list_pages( $args ); ?>
	</ul>
<?php

}


/**
 * Shorter Excerpts
 *
 * @param int $length Default excerpt length.
 * @return int
 */
function isca_excerpt_length( $length ) {

	// No format so this is a standard blog post.
	if ( ! get_post_format() ) {
		return 70;
	}

	return 20;

}

add_filter( 'excerpt_length', 'isca_excerpt_length', 999 );


/**
 * Comments Callback
 *
 * This code abstracts out comment code and makes the markup editable
 *
 * @param object $comment Comment object.
 * @param array  $args Comment arguments.
 * @param Ini	 $depth Comment depth.
 */
function isca_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;

?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard clearfloat">
				<?php echo get_avatar( $comment, $size = '35' ); ?>
				<div class="commentmetadata">
					<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
					<div class="comment-date">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php printf( __( '%1$s &bull; %2$s', 'isca' ), get_comment_date(), get_comment_time() ); ?>
						</a>
						<?php edit_comment_link( __( 'Edit', 'isca' ) ); ?>
					</div>
				</div>
			</div>
<?php
	if ( 0 == $comment->comment_approved ) {
?>
				<p class="comment-mod"><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'isca' ); ?></em></p>
<?php
	}

	comment_text();
?>
			<div class="reply">
<?php
	comment_reply_link(
		array_merge(
			$args,
			array(
				'depth' => $depth,
				'reply_text' => __( 'Reply &darr;', 'isca' ),
				'login_text' => __( 'Log in to reply', 'isca' ),
				'max_depth' => $args['max_depth'],
			)
		)
	);
?>
			</div>
		</div>
<?php
}


/**
 * Fill empty post thumbnails with images from the first attachment added to a post
 *
 * @param type $html
 * @param type $post_id
 * @param type $thumbnail_id
 * @param type $size
 * @return type
 */
function isca_post_thumbnail_html( $html, $post_id, $thumbnail_id, $size = '' ) {

	if ( empty( $html ) ) {

		$values = get_attached_media( 'image', $post_id );

		if ( $values ) {
			foreach ( $values as $child_id => $attachment ) {

				$html = wp_get_attachment_image( $child_id, $size );
				break;

			}
		}
	}

	return $html;

}

add_filter( 'post_thumbnail_html', 'isca_post_thumbnail_html', 10, 4 );


/**
 * Work out what class to use for the body content.
 *
 * @param boolean $echo Should we display the class or return it.
 * @return string
 */
function isca_content_class( $echo = true ) {

	$content_class = '';
	if ( '' === isca_sidebar() ) {
		$content_class = 'no-sidebar';
	}

	if ( $echo ) {
		echo $content_class;
	} else {
		return $content_class;
	}

}


/**
 * Work out what class to use in the row.
 */
function isca_row_class() {

	$class = 'row';

	if ( is_singular() ) {
		$class = 'content_row';
	}

	echo $class;

}


/**
 * Set the content width for better content scaling.
 *
 * @global type $content_width
 */
function isca_set_content_width() {

	global $content_width;

	if ( is_singular() && 'no-sidebar' === isca_content_class( false ) || is_page_template( 'custom-page-fullwidth.php' ) ) {
		$content_width = 946;
	}

	if ( is_archive() || is_home() || is_search() ) {
		$content_width = 761;
	}

}

add_action( 'template_redirect', 'isca_set_content_width' );

if ( ! isset( $content_width ) ) {
	$content_width = 676;
}


/**
 * Work out if the sidebar should be displayed or not.
 */
function isca_sidebar() {

	$sidebar = '';

	if ( is_singular() && is_active_sidebar( 'sidebar-1' ) && ! is_page_template( 'custom-page-fullwidth.php' ) ) {
		$sidebar = 'sidebar-1';
	}

	return $sidebar;

}


/**
 * Grab a url from the post content for displaying on a link post type.
 *
 * @return type
 */
function isca_url_grabber() {

	$url = false;

	$content = get_the_content();

	$DOM = new DOMDocument;
	$DOM->loadHTML( $content );
	$items = $DOM->getElementsByTagName( 'a' );

	foreach ( $items as $link ) {
		if ( $link->nodeValue && $link->getAttribute( 'href' ) ) {
			$url = array(
				'text' => esc_attr( $link->nodeValue ),
				'url' => esc_url( $link->getAttribute( 'href' ) ),
			);

			break;
		}
	}

	return $url;

}


/**
 * A wrapper for get_the_remaining content
 * includes some conditionals so it appears in the correct place, and adds a
 * containing div so it can be styled nicely
 */
function isca_remaining_content() {

	// Only display this on a single post
	// Exclude chat format since it will be output twice if I don't.
	if ( is_single() && in_array( get_post_format(), array( 'image', 'audio', 'video', 'quote' ) ) ) {

		$content = get_the_content( __( 'Continue &rarr;', 'isca' ) );

		if ( $content ) {
			echo '<div class="entry">';
			echo $content;
			echo '<div>';
		}
	}

}



// Filter the content of chat posts.
add_filter( 'the_content', 'isca_format_chat_content' );

// Auto-add paragraphs to the chat text.
add_filter( 'isca_post_format_chat_text', 'wpautop' );


/**
 * This function filters the post content when viewing a post with the "chat" post format.  It formats the
 * content with structured HTML markup to make it easy for theme developers to style chat posts.  The
 * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can
 * have 100s of speakers in your chat post, each with their own, unique classes for styling.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
function isca_format_chat_content( $content ) {

	global $_post_format_chat_ids;

	/* If this is not a 'chat' post, return the content. */
	if ( ! has_post_format( 'chat' ) ) {
		return $content;
	}

	/* Set the global variable of speaker IDs to a new, empty array for this chat. */
	$_post_format_chat_ids = array();

	/* Allow the separator (separator for speaker/text) to be filtered. */
	$separator = apply_filters( 'isca_post_format_chat_separator', ':' );

	/* Open the chat transcript div and give it a unique ID based on the post ID. */
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat">';

	/* Split the content to get individual chat rows. */
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

	/* Loop through each row and format the output. */
	foreach ( $chat_rows as $chat_row ) {

		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {

			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[1] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = isca_format_chat_row_id( $chat_author );

			/* Open the chat row. */
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

			/* Add the chat row author. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'isca_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';

			/* Add the chat row text. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'isca_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

			/* Close the chat row. */
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';

		}

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */
		else {

			/* Make sure we have text. */
			if ( ! empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'isca_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'isca_post_format_chat_content', $chat_output );
}


/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John"
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function isca_format_chat_row_id( $chat_author ) {

	global $_post_format_chat_ids;

	/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
	$chat_author = strtolower( strip_tags( $chat_author ) );

	/* Add the chat author to the array. */
	$_post_format_chat_ids[] = $chat_author;

	/* Make sure the array only holds unique values. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

	/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;

}

// Load theme helpers.
include( 'helpers/index.php' );
