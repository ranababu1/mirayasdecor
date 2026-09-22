<?php
/**
 * Mirayas Decor theme bootstrap.
 *
 * Loads the modular include files. Each module is self-contained, and the
 * module list is filterable so a child theme can add or replace modules.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * The theme version, used for cache busting assets.
 */
if ( ! defined( 'MIRAYAS_VERSION' ) ) {
	define( 'MIRAYAS_VERSION', '1.0.0' );
}

/**
 * Absolute filesystem path to the theme directory, without a trailing slash.
 */
if ( ! defined( 'MIRAYAS_DIR' ) ) {
	define( 'MIRAYAS_DIR', get_template_directory() );
}

/**
 * Theme directory URL, without a trailing slash.
 *
 * Always append a leading slash when concatenating asset paths, e.g.
 * `MIRAYAS_URI . '/assets/css/'`. Omitting it produces URLs like
 * `/themes/mirayasdecorassets/…` that silently 404.
 */
if ( ! defined( 'MIRAYAS_URI' ) ) {
	define( 'MIRAYAS_URI', get_template_directory_uri() );
}

/**
 * Whether WooCommerce is active.
 *
 * @return bool
 */
function mirayas_has_woocommerce() {
	return class_exists( 'WooCommerce' );
}

/**
 * The list of include modules, in load order.
 *
 * @return array
 */
function mirayas_modules() {
	return (array) apply_filters(
		'mirayas_modules',
		array(
			'setup',              // Theme supports, menus, image sizes, widget areas.
			'enqueue',            // Styles, scripts and font preloads.
			'performance',        // Asset trimming and rendering hints.
			'security',           // Hardening: version hints, XML-RPC, head cleanup.
			'seo',                // Meta description, social meta, breadcrumb schema.
			'template-functions', // Icon, breadcrumb and pagination helpers.
			'template-hooks',     // Front page and template hook wiring.
			'woocommerce',        // WooCommerce integration (no-op when inactive).
			'customizer',         // Customizer settings and controls.
		)
	);
}

foreach ( mirayas_modules() as $mirayas_module ) {
	$mirayas_path = MIRAYAS_DIR . '/inc/' . $mirayas_module . '.php';

	if ( is_readable( $mirayas_path ) ) {
		require $mirayas_path;
	}
}