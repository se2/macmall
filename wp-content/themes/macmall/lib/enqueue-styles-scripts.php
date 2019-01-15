<?php
/**
 * Enqueue scripts and styles.
 */
function ttg_wp_scripts() {

	// Lightbox2
	wp_enqueue_style( 'lightbox2', get_template_directory_uri() . '/js/lightbox2/dist/css/lightbox.min.css' );
	wp_enqueue_script( 'lightbox2', get_template_directory_uri() . '/js/lightbox2/dist/js/lightbox.min.js', ['jquery'] );

  wp_enqueue_style('macmall-style', get_template_directory_uri() . '/dist/app.css');
  wp_enqueue_script('app', get_template_directory_uri() . '/dist/app.js', ['jquery']);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ttg_wp_scripts' );
