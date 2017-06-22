<?php
/**
 * Popper C functions and definitions.
 * @package popper_c
 */

/**
 * Make die.
 */
if ( is_admin()
  && false === get_transient( 'c_theme_php_version' )
  && version_compare( PHP_VERSION, '5.3.0', '<' )
  ) {

	set_transient( 'c_theme_php_version', 'fail', MINUTE_IN_SECONDS * 5  );
	wp_die(
		'This theme requires PHP 5.3 or greater.<br>Please contact your web host to upgrade the PHP version on your server.',
		'Error: PHP version update required!',
		array( 'back_link' => true )
	);
}

/**
 * Make setup.
 */
add_action( 'after_setup_theme', function() {

	// Scripts to be loaded asynchronously or deferred.
	set_theme_mod( 'async-scripts', array(
		'popper-functions',
		'popper-skip-link-focus-fix',
		'twitter-widgets',
	) );
	set_theme_mod( 'defer-scripts', array(
		// 'homeroom-light',
		// 'the-neverending-homepage',
		'comment-reply',
	) );
});

/**
 * Enqueue scripts and stylesheets.
 */
add_action( 'wp_enqueue_scripts', function() {

	wp_dequeue_style( 'popper-style' );
	wp_deregister_style( 'popper-style' );

	wp_register_style(
		'popper-style',
		get_template_directory_uri() . '/style.css'
	);

	wp_register_style(
		'popper-c',
		get_stylesheet_uri(),
		array( 'popper-style' )
	);

	wp_register_script(
		'twitter-widgets',
		'https://platform.twitter.com/widgets.js',
		false,
		false,
		true
	);

	wp_register_script(
		'homeroom-light',
		get_stylesheet_directory_uri() . '/assets/js/homeroom.light.js',
		'the-neverending-homepage',
		false,
		true
	);

	wp_enqueue_style( 'popper-style' );

	wp_enqueue_style( 'popper-c' );

	wp_enqueue_script( 'twitter-widgets' );

	// wp_enqueue_script( 'homeroom-light' );
});

/**
 * Make async.
 * @link https://matthewhorne.me/defer-async-wordpress-scripts/
 */
/*
add_filter( 'script_loader_tag', function ( $tag, $handle ) {

	// Async
	$async_scripts = (array) get_theme_mod( 'async-scripts' );

	foreach( $async_scripts as $async_script ) {

		if ( $async_script === $handle ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}
	}

	// Defer
	$defer_scripts = (array) get_theme_mod( 'defer-scripts' );

	foreach( $defer_scripts as $defer_script ) {

		if ( $defer_script === $handle ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}
	}

	return $tag;

}, 10, 2 );
*/

/**
 * Make html.js on the front-end.
 */
add_action( 'wp_print_scripts', function() {

	is_admin() || print '<script>(function(h){h.className += " js"})(document.documentElement)</script>';
}, 0 );

/**
 * Trigger infinity.
 * @link https://github.com/Automattic/jetpack/blob/master/modules/infinite-scroll/
 */
// require get_stylesheet_directory() . '/inc/infinity.php';

/**
 * Add contact methods.
 * @link https://github.com/beaulebens/Homeroom
 */
add_filter( 'user_contactmethods', function ( $methods ) {

	$methods['twitter'] = __( 'Twitter @', 'popper-c' );

	ksort( $methods );

	return $methods;
});

/**
 * @todo Missing Desc
 *
 *
 *
 */
function homeroom_tags_list() {

	$tags_list = get_the_tag_list(
		'<li class="post-tag"><span class="post-tag_hash">#</span>',
		'</li> <li class="post-tag"><span class="post-tag_hash">#</span>',
		'</li>'
	);

	if ( $tags_list ) : ?>
		<ul class="post-tags">
			<?php echo $tags_list; ?>
		</ul>
	<?php
	endif;
}