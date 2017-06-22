<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package popper_c
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<p><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'popper' ) ); ?>" target="_none" rel="nofollow"><?php
				printf(
					esc_html__( 'Proudly powered by %s', 'popper' ),
					'WordPress'
				); ?></a><br />
			<?php
				printf(
					esc_html__( 'Theme: %1$s', 'popper' ),
					'<a href="https://github.com/glueckpress/popper-c" target="_none" rel="nofollow">C</a> · a child of <a href="https://wordpress.org/themes/popper/" target="_none" rel="nofollow">Popper</a>'
			); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
