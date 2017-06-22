<?php
/**
 * Template part for displaying aside posts as tweets.
 *
 * @package popper_c
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( $twitter_id = get_post_meta( get_the_ID(), 'twitter_id', true ) ) : ?>
	<blockquote class="twitter-tweet">
		<?php
		the_content();

		if ( ! $permalink = get_post_meta( get_the_ID(), 'twitter_permalink', true ) ) {
			if ( $twitterer = get_user_meta( $post->post_author, 'twitter' ) ) {
				$permalink = "https://twitter.com/" . esc_attr( $twitterer ) . "/statuses/{$twitter_id}";
			} else {
				$permalink = get_permalink();
			}
		}
		?>
		<a href="<?php echo esc_url( $permalink ); ?>" rel="nofollow" style="display:none;">Twitter</a>
	</blockquote>
	<footer class="entry-footer">
		<?php homeroom_tags_list(); ?>
		<p><?php
			printf(
				esc_html( __( 'Posted on %s', 'popper-c' ) ),
				'<a href="' . esc_url( $permalink ) . '" rel="nofollow">Twitter</a>'
			); ?></p>
	</footer><!-- .entry-meta -->
<?php else : ?>
	<div class="entry-content">
		<?php the_content(''); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php popper_entry_footer(); ?>
	</footer><!-- .entry-footer -->

<?php endif; ?>
</article><!-- #post-## -->
