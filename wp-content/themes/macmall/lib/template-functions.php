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
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

/**
 * Replace the home link URL
 */

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );

function woo_custom_breadrumb_home_url() {
	return get_permalink( wc_get_page_id( 'shop' ) );
}

/**
 * Rename "home" in breadcrumb
 */

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );

function wcc_change_breadcrumb_home_text( $defaults ) {
	$defaults['home'] = 'Shop';
	return $defaults;
}

//* http://gasolicious.com/remove-tabs-keep-product-description-woocommerce/
// Removes woocommerce tabs
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Re-add product full description
function woocommerce_template_product_description() {
	wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_after_single_product', 'woocommerce_template_product_description', 20 );

/**
 * Mega Menu id to toggle
 * Add menu image to sub-menu
 */
function wp_nav_menu_atts( $atts, $item, $args ) {
	if ( '0' === $item->menu_item_parent ) {
		$atts['data-mega'] = $item->ID;
	} else {
		$thumbnail_id = get_woocommerce_term_meta( $item->object_id, 'thumbnail_id', true );
		$image        = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
			$new = '';
			if ( get_field( 'has_new_products', $item ) ) {
				$new = '<img class="new-sign" src="' . get_template_directory_uri() . '/img/new-sign.svg" alt="' . esc_html( $item->title ) . '">';
			}
			$item->title = '<img src="' . $image . '" alt="' . esc_html( $item->title ) . '">' . '<span>' . $item->title . '</span>' . $new;
		}
	}
	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'wp_nav_menu_atts', 10, 3 );

/**
 * Ajax get products
 *
 */
function get_ajax_products() {

	check_ajax_referer( 'get_products', 'nonce' );

	$html        = '';
	$page        = intval( filter_var( $_POST[ 'page' ], FILTER_SANITIZE_NUMBER_INT ) ) + 1;
	$product_cat = intval( filter_var( $_POST[ 'product_cat' ], FILTER_SANITIZE_NUMBER_INT ) );

	// Query Arguments
	$args = array(
		'post_type'      => array( 'product' ),
		'post_status'    => array( 'publish' ),
		'posts_per_page' => wc_get_default_products_per_row() * wc_get_default_product_rows_per_page(),
		'paged'          => $page,
		'orderby'        => 'menu_order', // use this for woocommerce
		'order'          => 'ASC', // use this for woocommerce
	);

	if ( $product_cat != -1 ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'ID',
				'terms'    => $product_cat,
				'operator' => 'IN'
			)
			);
	}

	$products_query = new WP_Query( $args );

	if ( $products_query->have_posts() ) {
		ob_start();
		while ( $products_query->have_posts() ) {
			$products_query->the_post();
			$html .= wc_get_template_part( 'content', 'product' );
		}
		wp_reset_postdata();
		$html = ob_get_clean();
	}
	echo $html;
	exit;
}

add_action( 'wp_ajax_get_ajax_products', 'get_ajax_products' );
add_action( 'wp_ajax_nopriv_get_ajax_products', 'get_ajax_products' );
