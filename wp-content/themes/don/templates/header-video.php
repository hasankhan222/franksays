<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0.14
 */
$eject_header_video = eject_get_header_video();
$eject_embed_video = '';
if (!empty($eject_header_video) && !eject_is_from_uploads($eject_header_video)) {
	if (eject_is_youtube_url($eject_header_video) && preg_match('/[=\/]([^=\/]*)$/', $eject_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$eject_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($eject_header_video) . '[/embed]' ));
			$eject_embed_video = eject_make_video_autoplay($eject_embed_video);
		} else {
			$eject_header_video = str_replace('/watch?v=', '/embed/', $eject_header_video);
			$eject_header_video = eject_add_to_url($eject_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$eject_embed_video = '<iframe src="' . esc_url($eject_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php eject_show_layout($eject_embed_video); ?></div><?php
	}
}
?>