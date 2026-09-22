<?php
/**
 * Styles and scripts.
 *
 * Every asset is a small, cacheable file loaded in a fixed dependency order:
 * fonts -> tokens -> base -> layout -> components -> utilities -> woocommerce.
 * All scripts are deferred via the WordPress 6.3+ script strategy arguments.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue front-end styles.
 */
function mirayas_enqueue_styles() {
	$mirayas_css = MIRAYAS_URI . '/assets/css/';

	wp_enqueue_style( 'mirayas-fonts', $mirayas_css . 'fonts.css', array(), MIRAYAS_VERSION );
	wp_enqueue_style( 'mirayas-tokens', $mirayas_css . 'tokens.css', array( 'mirayas-fonts' ), MIRAYAS_VERSION );
	wp_enqueue_style( 'mirayas-base', $mirayas_css . 'base.css', array( 'mirayas-tokens' ), MIRAYAS_VERSION );
	wp_enqueue_style( 'mirayas-layout', $mirayas_css . 'layout.css', array( 'mirayas-base' ), MIRAYAS_VERSION );
	wp_enqueue_style( 'mirayas-components', $mirayas_css . 'components.css', array( 'mirayas-layout' ), MIRAYAS_VERSION );
	wp_enqueue_style( 'mirayas-utilities', $mirayas_css . 'utilities.css', array( 'mirayas-components' ), MIRAYAS_VERSION );

	if ( mirayas_has_woocommerce() ) {
		wp_enqueue_style( 'mirayas-woocommerce', $mirayas_css . 'woocommerce.css', array( 'mirayas-utilities' ), MIRAYAS_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'mirayas_enqueue_styles' );

/**
 * Enqueue front-end scripts. Dependency-free vanilla JavaScript.
 *
 * The cart script is the single exception: it declares jQuery so it can listen
 * to WooCommerce's jQuery-based `added_to_cart` event (WooCommerce itself
 * requires jQuery on all shop pages) and open the cart drawer in response.
 */
function mirayas_enqueue_scripts() {
	$mirayas_js = MIRAYAS_URI . '/assets/js/';

	wp_enqueue_script(
		'mirayas-main',
		$mirayas_js . 'main.js',
		array(),
		MIRAYAS_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	wp_enqueue_script(
		'mirayas-navigation',
		$mirayas_js . 'navigation.js',
		array(),
		MIRAYAS_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( mirayas_has_woocommerce() ) {
		wp_enqueue_script(
			'mirayas-cart',
			$mirayas_js . 'cart.js',
			array( 'jquery' ),
			MIRAYAS_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);

		if ( is_product() ) {
			wp_enqueue_script(
				'mirayas-product',
				$mirayas_js . 'product.js',
				array(),
				MIRAYAS_VERSION,
				array(
					'in_footer' => true,
					'strategy'  => 'defer',
				)
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'mirayas_enqueue_scripts' );

/**
 * Preload the two fonts used above the fold (body + display faces). The italic
 * face is intentionally not preloaded and loads lazily on first use.
 */
function mirayas_preload_fonts() {
	$mirayas_fonts = MIRAYAS_URI . '/assets/fonts/';

	printf(
		"<link rel=\"preload\" href=\"%s\" as=\"font\" type=\"font/woff2\" crossorigin>\n",
		esc_url( $mirayas_fonts . 'inter-var.woff2' )
	);
	printf(
		"<link rel=\"preload\" href=\"%s\" as=\"font\" type=\"font/woff2\" crossorigin>\n",
		esc_url( $mirayas_fonts . 'fraunces-var.woff2' )
	);
}
add_action( 'wp_head', 'mirayas_preload_fonts', 1 );