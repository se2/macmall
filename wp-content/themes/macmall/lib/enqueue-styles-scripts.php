<?php
/**
 * Enqueue scripts and styles.
 */
function ttg_wp_scripts() {
	global $wp_query;
	// Lightbox2
	wp_enqueue_style( 'lightbox2', get_template_directory_uri() . '/js/lightbox2/dist/css/lightbox.min.css' );
	wp_enqueue_script( 'lightbox2', get_template_directory_uri() . '/js/lightbox2/dist/js/lightbox.min.js', ['jquery'] );

  wp_enqueue_style('macmall-style', get_template_directory_uri() . '/dist/app.css');
  wp_enqueue_script('app', get_template_directory_uri() . '/dist/app.js', ['jquery']);

	// Localize the script with new data
	$product_cat = is_product_category() ? intval( $wp_query->get_queried_object()->term_id ) : -1;
	$translation_array = array(
		'product_cat' => $product_cat,
		'ajax_nonce'  => wp_create_nonce( 'get_products' ),
	);
	wp_localize_script( 'app', 'woo', $translation_array );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ttg_wp_scripts' );
