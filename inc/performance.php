<?php
/**
 * Performance: trim scripts and styles the theme does not need, and add
 * browser hints that speed up rendering.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Remove emoji detection scripts and styles — the theme ships no emoji UI.
 */
function mirayas_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_img_url', '__return_false' );
}
add_action( 'init', 'mirayas_disable_emojis' );

/**
 * Drop stylesheet cruft the theme replaces with its own tokens and base layer.
 * The core block library is kept: it carries structural styles (columns,
 * galleries, images) that content depends on.
 */
function mirayas_dequeue_unused_styles() {
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'classic-theme-styles' );

	// Dashicons are admin/user-facing only.
	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'dashicons' );
	}
}
add_action( 'wp_enqueue_scripts', 'mirayas_dequeue_unused_styles', 100 );

/**
 * Remove the jquery-migrate dependency from the front end. jQuery itself is
 * kept because WooCommerce requires it on shop pages.
 *
 * @param WP_Scripts $scripts Scripts registry.
 */
function mirayas_remove_jquery_migrate( $scripts ) {
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}

	if ( ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			array( 'jquery-migrate' )
		);
	}
}
add_action( 'wp_default_scripts', 'mirayas_remove_jquery_migrate' );

/**
 * Decode all attachment images asynchronously.
 *
 * @param array $attr Image attributes.
 * @return array
 */
function mirayas_img_decoding_async( $attr ) {
	$attr['decoding'] = 'async';

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mirayas_img_decoding_async' );