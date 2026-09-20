<?php
/**
 * Security hardening: version hints removed, XML-RPC disabled and the classic
 * WordPress attack surface trimmed to what the store actually needs.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

// Remove generator meta tags (theme, WP and WooCommerce version disclosure).
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// The site exposes no XML-RPC publishing clients.
add_filter( 'xmlrpc_methods', '__return_empty_array' );
add_filter( 'xmlrpc_enabled', '__return_false' );

// Remove unnecessary <head> discovery links.
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

/**
 * Hide the WordPress core version in asset URLs while preserving cache-busting
 * query strings for anything else (including this theme's own versioned assets).
 *
 * @param string $src Asset URL.
 * @return string
 */
function mirayas_strip_wp_version_from_assets( $src ) {
	if ( ! $src ) {
		return $src;
	}

	$mirayas_core = 'ver=' . get_bloginfo( 'version' );

	if ( false !== strpos( $src, $mirayas_core ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}
add_filter( 'style_loader_src', 'mirayas_strip_wp_version_from_assets', 15 );
add_filter( 'script_loader_src', 'mirayas_strip_wp_version_from_assets', 15 );