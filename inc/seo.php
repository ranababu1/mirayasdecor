<?php
/**
 * SEO: meta description, Open Graph / Twitter cards and a BreadcrumbList
 * schema fallback for non-Commerce pages. When a dedicated SEO plugin is
 * active every theme output steps aside to avoid duplication.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether a dedicated SEO plugin is managing meta output.
 *
 * @return bool
 */
function mirayas_seo_active() {
	return (bool) apply_filters(
		'mirayas_seo_plugin_active',
		defined( 'WPSEO_VERSION' )       // Yoast SEO.
			|| defined( 'RANK_MATH_VERSION' ) // Rank Math.
			|| defined( 'AIOSEO_VERSION' )   // All in One SEO.
			|| defined( 'SEOPRESS_VERSION' )  // SEOPress.
	);
}

/**
 * Build the meta description text for the current view.
 *
 * @return string
 */
function mirayas_get_meta_description() {
	if ( is_singular() ) {
		$mirayas_post = get_queried_object();

		if ( $mirayas_post instanceof WP_Post ) {
			$mirayas_text = has_excerpt( $mirayas_post ) ? $mirayas_post->post_excerpt : $mirayas_post->post_content;
			$mirayas_text = wp_strip_all_tags( $mirayas_text );

			if ( '' !== $mirayas_text ) {
				return wp_html_excerpt( $mirayas_text, 160, '&hellip;' );
			}
		}

		return get_bloginfo( 'description' );
	}

	if ( is_front_page() ) {
		return get_bloginfo( 'description' );
	}

	$mirayas_desc = get_the_archive_description();

	if ( $mirayas_desc ) {
		return wp_html_excerpt( wp_strip_all_tags( $mirayas_desc ), 160, '&hellip;' );
	}

	return get_bloginfo( 'description' );
}

/**
 * Output the meta description.
 */
function mirayas_meta_description() {
	if ( mirayas_seo_active() ) {
		return;
	}

	printf(
		'<meta name="description" content="%s">' . "\n",
		esc_attr( mirayas_get_meta_description() )
	);
}
add_action( 'wp_head', 'mirayas_meta_description', 5 );

/**
 * Output Open Graph and Twitter card meta for singular views.
 */
function mirayas_social_meta() {
	if ( mirayas_seo_active() || ! is_singular() ) {
		return;
	}

	$mirayas_title = wp_get_document_title();
	$mirayas_desc  = mirayas_get_meta_description();

	printf(
		'<meta property="og:site_name" content="%s">' . "\n",
		esc_attr( get_bloginfo( 'name' ) )
	);
	printf(
		'<meta property="og:title" content="%s">' . "\n",
		esc_attr( $mirayas_title )
	);
	printf(
		'<meta property="og:description" content="%s">' . "\n",
		esc_attr( $mirayas_desc )
	);
	printf(
		'<meta property="og:url" content="%s">' . "\n",
		esc_url( get_permalink() )
	);
	printf(
		'<meta property="og:type" content="article">' . "\n"
	);

	if ( has_post_thumbnail() ) {
		$mirayas_image = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );

		if ( $mirayas_image ) {
			printf(
				'<meta property="og:image" content="%s">' . "\n",
				esc_url( $mirayas_image )
			);
			printf(
				'<meta name="twitter:card" content="summary_large_image">' . "\n"
			);
		}
	} else {
		printf(
			'<meta name="twitter:card" content="summary">' . "\n"
		);
	}
}
add_action( 'wp_head', 'mirayas_social_meta', 6 );

/**
 * Build the breadcrumb trail when WooCommerce is unavailable. Items are
 * `[ name, url ]` pairs, mirroring the WC_Breadcrumb crumb format.
 *
 * @return array
 */
function mirayas_get_breadcrumb_items() {
	$mirayas_items = array(
		array( _x( 'Home', 'breadcrumb', 'mirayas-decor' ), home_url( '/' ) ),
	);

	if ( is_front_page() ) {
		return $mirayas_items;
	}

	$mirayas_journal_id = (int) get_option( 'page_for_posts' );

	if ( is_singular( 'post' ) ) {
		if ( $mirayas_journal_id ) {
			$mirayas_items[] = array( get_the_title( $mirayas_journal_id ), get_permalink( $mirayas_journal_id ) );
		}

		$mirayas_items[] = array( get_the_title(), '' );
	} elseif ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $mirayas_ancestor ) {
			$mirayas_items[] = array( get_the_title( $mirayas_ancestor ), get_permalink( $mirayas_ancestor ) );
		}

		$mirayas_items[] = array( get_the_title(), '' );
	} elseif ( is_home() ) {
		$mirayas_items[] = array(
			$mirayas_journal_id ? get_the_title( $mirayas_journal_id ) : __( 'Journal', 'mirayas-decor' ),
			'',
		);
	} elseif ( is_category() || is_tag() || is_date() || is_author() ) {
		if ( $mirayas_journal_id ) {
			$mirayas_items[] = array( get_the_title( $mirayas_journal_id ), get_permalink( $mirayas_journal_id ) );
		}

		$mirayas_items[] = array( wp_strip_all_tags( get_the_archive_title() ), '' );
	} elseif ( is_search() ) {
		$mirayas_items[] = array( __( 'Search results', 'mirayas-decor' ), '' );
	} elseif ( is_404() ) {
		$mirayas_items[] = array( __( 'Error 404', 'mirayas-decor' ), '' );
	}

	return apply_filters( 'mirayas_breadcrumb_items', $mirayas_items );
}

/**
 * Output a BreadcrumbList JSON-LD block for the given trail.
 *
 * @param array $items Crumb pairs: `[ name, url ]`.
 */
function mirayas_breadcrumb_schema( $items ) {
	if ( mirayas_seo_active() || count( $items ) < 2 ) {
		return;
	}

	$mirayas_list = array();

	foreach ( array_values( $items ) as $mirayas_index => $mirayas_item ) {
		$mirayas_crumb = array(
			'@type'    => 'ListItem',
			'position' => $mirayas_index + 1,
			'name'     => $mirayas_item[0],
		);

		if ( ! empty( $mirayas_item[1] ) ) {
			$mirayas_crumb['item'] = $mirayas_item[1];
		}

		$mirayas_list[] = $mirayas_crumb;
	}

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode(
			array(
				'@context'        => 'https://schema.org',
				'@type'           => 'BreadcrumbList',
				'itemListElement' => $mirayas_list,
			)
		)
	);
}