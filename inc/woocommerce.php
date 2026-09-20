<?php
/**
 * WooCommerce integration: gallery features, template wrappers and shop
 * layout settings. Every hook is guarded so the theme keeps running cleanly
 * with the plugin deactivated.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enable the product gallery features.
 */
function mirayas_wc_setup() {
	if ( ! mirayas_has_woocommerce() ) {
		return;
	}

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'mirayas_wc_setup' );

/**
 * Remove the default WooCommerce wrapper, breadcrumbs and sidebar — the
 * theme provides its own containers and breadcrumb markup (page-header
 * component) and the shop runs sidebar-free.
 */
function mirayas_wc_remove_defaults() {
	if ( ! mirayas_has_woocommerce() ) {
		return;
	}

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_end', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'after_setup_theme', 'mirayas_wc_remove_defaults', 20 );

/**
 * Open the theme container inside shop templates. The <main> element comes
 * from the template overrides themselves.
 */
function mirayas_wc_wrapper_open() {
	echo '<div class="container">';
}
add_action( 'woocommerce_before_main_content', 'mirayas_wc_wrapper_open', 10 );

/**
 * Close the theme container.
 */
function mirayas_wc_wrapper_close() {
	echo '</div>';
}
add_action( 'woocommerce_after_main_content', 'mirayas_wc_wrapper_close', 10 );

/**
 * Drop the default WooCommerce stylesheet — the theme ships a complete
 * replacement (assets/css/woocommerce.css) and a second copy would fight it.
 *
 * @param array $styles Registered styles.
 * @return array
 */
function mirayas_wc_dequeue_styles( $styles ) {
	return array();
}
add_filter( 'woocommerce_enqueue_styles', 'mirayas_wc_dequeue_styles' );

/**
 * Shop grid: three products per row.
 *
 * @return int
 */
function mirayas_wc_loop_columns() {
	return (int) apply_filters( 'mirayas_shop_columns', 3 );
}
add_filter( 'loop_shop_columns', 'mirayas_wc_loop_columns' );

/**
 * Shop grid: twelve products per page.
 *
 * @return int
 */
function mirayas_wc_products_per_page() {
	return (int) apply_filters( 'mirayas_products_per_page', 12 );
}
add_filter( 'loop_shop_per_page', 'mirayas_wc_products_per_page' );

/**
 * Related products: three, in one row.
 *
 * @param array $args Related products query args.
 * @return array
 */
function mirayas_wc_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'mirayas_wc_related_products_args' );

/**
 * Cross-sells on the cart page: three columns.
 *
 * @return int
 */
function mirayas_wc_cross_sells_columns() {
	return (int) apply_filters( 'mirayas_cross_sells_columns', 3 );
}
add_filter( 'woocommerce_cross_sells_columns', 'mirayas_wc_cross_sells_columns' );

/**
 * Cross-sells on the cart page: three products.
 *
 * @return int
 */
function mirayas_wc_cross_sells_total() {
	return (int) apply_filters( 'mirayas_cross_sells_total', 3 );
}
add_filter( 'woocommerce_cross_sells_total', 'mirayas_wc_cross_sells_total' );