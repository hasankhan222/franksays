<?php
/**
 * Footer code and content
 *
 * @package Isca
 */

?>
			</section>
<?php

	if ( ! is_page_template( 'custom-page-fullwidth.php' ) ) {
		get_sidebar();
	}

?>
		</div>
	</div>
</div>

<footer class="site-footer" role="contentinfo">
<?php

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		echo '<aside class="row" id="footer-widgets">';
		dynamic_sidebar( 'sidebar-2' );
		echo '</aside>';
	}

?>

	<section id="footer-wrap">
		<section class="row">
			<span class="credit-wp">				
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'isca' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'isca' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'isca' ), 'WordPress' ); ?></a>
			</span>
			<span class="sep"> &bull; </span>
			<span class="credit-protheme"><?php printf( __( 'Theme: %1$s by %2$s.', 'isca' ), 'isca', '<a href="https://prothemedesign.com/" rel="designer">Pro Theme Design</a>' ); ?></span>
		</section>
	</section>
</footer>
<?php wp_footer(); ?>
</body>
</html>
