<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ttg-wp-theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ttg_wp_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'ttg_wp_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ttg_wp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ttg_wp_pingback_header' );

/**
 * WooCommerce Hooks/Functions.
 */

 // Remove the sorting dropdown from Woocommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );

// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );

/**
 * Use percentage for sale price difference.
 */
function macmall_percentage_sale( $text, $post, $product ) {

	$text = '<span class="onsale">';

	if ( $product->is_type( 'variable' ) ) {
		$variation = new WC_Product_Variation( $product->get_children()[0] );

		$regular = $variation->get_regular_price();
		$sale    = $variation->get_sale_price();

		if ( isset( $sale ) ) {
			$discount = ceil( ( ( $sale - $regular ) / $regular ) * 100 );
		}

		$text .= $discount . '%';

		$text .= '</span>';

		return $text;
	}

}

add_filter( 'woocommerce_sale_flash', 'macmall_percentage_sale', 10, 3 );

// Remove Add to Cart Button Loop page
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
