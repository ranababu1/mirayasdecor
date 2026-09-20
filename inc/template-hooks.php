<?php
/**
 * Front page hooks.
 *
 * Each callback renders one home page section from template-parts/home/ and
 * can be toggled from the Customizer (mirayas_show_<section>) or removed
 * entirely from a child theme.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether a front page section is enabled.
 *
 * @param string $section Section slug: hero, featured, collections, story,
 *                        editorial, trust or newsletter.
 * @return bool
 */
function mirayas_front_section_enabled( $section ) {
	return (bool) apply_filters(
		'mirayas_front_section_enabled',
		(bool) get_theme_mod( 'mirayas_show_' . $section, true ),
		$section
	);
}

/**
 * Hero: full-bleed statement with product spotlight.
 */
function mirayas_render_front_hero() {
	if ( ! mirayas_front_section_enabled( 'hero' ) ) {
		return;
	}

	get_template_part( 'template-parts/home/hero' );
}
add_action( 'mirayas_front_hero', 'mirayas_render_front_hero' );

/**
 * Featured products: highlighted recent arrivals.
 */
function mirayas_render_front_featured() {
	if ( ! mirayas_front_section_enabled( 'featured' ) ) {
		return;
	}

	get_template_part( 'template-parts/home/featured' );
}
add_action( 'mirayas_front_featured', 'mirayas_render_front_featured' );

/**
 * Collections: shop-by-room category tiles.
 */
function mirayas_render_front_collections() {
	if ( ! mirayas_front_section_enabled( 'collections' ) ) {
		return;
	}

	get_template_part( 'template-parts/home/collections' );
}
add_action( 'mirayas_front_collections', 'mirayas_render_front_collections' );

/**
 * Story: brand narrative with imagery.
 */
function mirayas_render_front_story() {
	if ( ! mirayas_front_section_enabled( 'story' ) ) {
		return;
	}

	get_template_part( 'template-parts/home/story' );
}
add_action( 'mirayas_front_story', 'mirayas_render_front_story' );

/**
 * Editorial: latest journal entries.
 */
function mirayas_render_front_editorial() {
	if ( ! mirayas_front_section_enabled( 'editorial' ) ) {
		return;
	}

	get_template_part( 'template-parts/home/editorial' );
}
add_action( 'mirayas_front_editorial', 'mirayas_render_front_editorial' );

/**
 * Trust: service guarantees strip.
 */
function mirayas_render_front_trust() {
	if ( ! mirayas_front_section_enabled( 'trust' ) ) {
		return;
	}

	get_template_part( 'template-parts/home/trust' );
}
add_action( 'mirayas_front_trust', 'mirayas_render_front_trust' );

/**
 * Newsletter: email capture panel.
 */
function mirayas_render_front_newsletter() {
	if ( ! mirayas_front_section_enabled( 'newsletter' ) ) {
		return;
	}

	get_template_part( 'template-parts/home/newsletter' );
}
add_action( 'mirayas_front_newsletter', 'mirayas_render_front_newsletter' );