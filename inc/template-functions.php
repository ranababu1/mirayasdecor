<?php
/**
 * Template helper functions: inline SVG icons, placeholders, breadcrumbs,
 * pagination and Customizer defaults.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * The inline SVG icon library.
 *
 * Every icon uses currentColor so it inherits the text colour of its context.
 * The set is filterable via `mirayas_icons`, letting a child theme add or
 * replace icons without copying the helper functions.
 *
 * @return array
 */
function mirayas_icons() {
	return apply_filters(
		'mirayas_icons',
		array(
			'search'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m16.5 16.5 4.5 4.5"/></svg>',
			'arrow-left'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>',
			'arrow-right'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>',
			'chevron-right' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>',
			'chevron-down'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>',
			'cart'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
			'account'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
			'menu'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>',
			'close'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>',
			'star'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01Z"/></svg>',
			'star-filled'   => '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01Z"/></svg>',
			'check'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>',
			'truck'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>',
			'shield'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>',
			'refresh'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>',
			'leaf'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>',
			'package'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>',
			'instagram'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37Z"/><path d="M17.5 6.5h.01"/></svg>',
			'facebook'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
			'pinterest'     => '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.08 2.46 7.58 6 9.14-.08-.78-.16-2 .04-2.9.21-.9 1.36-5.45 1.36-5.45s-.35-.7-.35-1.74c0-1.63.94-2.85 2.12-2.85 1 0 1.48.75 1.48 1.65 0 1-.64 2.5-.97 3.88-.27 1.17.59 2.12 1.74 2.12 2.09 0 3.5-2.68 3.5-5.86 0-2.42-1.6-4.13-4.53-4.13-3.31 0-5.33 2.46-5.33 5.2 0 .75.22 1.28.56 1.68.16.19.19.27.13.49l-.18.73c-.06.23-.25.31-.46.23-1.26-.52-1.84-1.9-1.84-3.46 0-2.57 2.17-5.67 6.46-5.67 3.44 0 5.7 2.5 5.7 5.16 0 3.54-1.97 6.17-4.92 6.17-.98 0-1.91-.53-2.22-1.13l-.6 2.38c-.22.84-.82 1.9-1.22 2.55.98.29 2.02.45 3.1.45 5.52 0 10-4.48 10-10S17.52 2 12 2Z"/></svg>',
			'whatsapp'      => '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.16-.17.2-.35.22-.64.08-.3-.15-1.26-.47-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.53.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.61-.91-2.2-.25-.58-.5-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.06 2.87 1.21 3.07c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.7.62.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2-1.41.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.34m-5.42 7.4h-.01a9.87 9.87 0 0 1-5.03-1.37l-.36-.22-3.74.98 1-3.65-.24-.37a9.86 9.86 0 0 1-1.51-5.26c0-5.45 4.44-9.88 9.89-9.88 2.64 0 5.13 1.02 7.02 2.88a9.83 9.83 0 0 1 2.88 7c0 5.45-4.44 9.88-9.89 9.88M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 1.9.43 3.71 1.19 5.32L2 22l4.84-1.13A9.96 9.96 0 0 0 12 22c5.52 0 10-4.48 10-10"/></svg>',
		)
	);
}

/**
 * Get an inline SVG icon.
 *
 * The markup comes from the fixed internal library (see mirayas_icons()) and
 * is safe to print. Icons are decorative by default (aria-hidden).
 *
 * @param string $name Icon name.
 * @param int    $size Pixel width/height.
 * @return string
 */
function mirayas_get_icon( $name, $size = 20 ) {
	$mirayas_icons = mirayas_icons();

	if ( ! isset( $mirayas_icons[ $name ] ) ) {
		return '';
	}

	return str_replace(
		'<svg ',
		sprintf(
			'<svg width="%d" height="%d" aria-hidden="true" focusable="false" ',
			(int) $size,
			(int) $size
		),
		$mirayas_icons[ $name ]
	);
}

/**
 * Print an inline SVG icon.
 *
 * @param string $name Icon name.
 * @param int    $size Pixel width/height.
 */
function mirayas_the_icon( $name, $size = 20 ) {
	echo mirayas_get_icon( $name, $size ); // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG from the internal library.
}

/**
 * Print a tone-on-tone placeholder block used where an image is missing,
 * e.g. a product without a featured image. Aspect ratio is set by CSS.
 */
function mirayas_the_placeholder() {
	printf(
		'<svg class="placeholder" viewBox="0 0 4 5" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false"><rect width="4" height="5" fill="currentColor" opacity="0.08"/></svg>'
	);
}

/**
 * Render the breadcrumb trail.
 *
 * With WooCommerce active this mirrors the core woocommerce_breadcrumb()
 * flow — a WC_Breadcrumb instance builds the trail and the
 * `woocommerce_breadcrumb` action fires with the same argument shape — so the
 * plugin's BreadcrumbList structured data keeps being emitted unmodified.
 * Without WooCommerce a lightweight fallback trail is built instead (see
 * inc/seo.php) and the schema is printed here.
 */
function mirayas_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	if ( mirayas_has_woocommerce() && class_exists( 'WC_Breadcrumb' ) ) {
		$mirayas_breadcrumb = new WC_Breadcrumb();
		$mirayas_breadcrumb->add_crumb(
			_x( 'Home', 'breadcrumb', 'mirayas-decor' ),
			apply_filters( 'woocommerce_breadcrumb_home_url', home_url( '/' ) )
		);
		$mirayas_breadcrumb->generate();

		// WC has no trail rule for the posts page; append the Journal crumb.
		if ( is_home() ) {
			$mirayas_journal_id = (int) get_option( 'page_for_posts' );

			if ( $mirayas_journal_id ) {
				$mirayas_breadcrumb->add_crumb( get_the_title( $mirayas_journal_id ), get_permalink( $mirayas_journal_id ) );
			}
		}

		do_action(
			'woocommerce_breadcrumb',
			$mirayas_breadcrumb,
			array( 'breadcrumb' => $mirayas_breadcrumb->get_breadcrumb() )
		);

		$mirayas_items = $mirayas_breadcrumb->get_breadcrumb();
	} else {
		$mirayas_items = mirayas_get_breadcrumb_items();
		mirayas_breadcrumb_schema( $mirayas_items );
	}

	$mirayas_items = apply_filters( 'mirayas_breadcrumbs', $mirayas_items );

	if ( count( $mirayas_items ) < 2 ) {
		return;
	}

	$mirayas_last = count( $mirayas_items ) - 1;
	?>
	<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'mirayas-decor' ); ?>">
		<ol class="breadcrumbs__list">
			<?php foreach ( $mirayas_items as $mirayas_index => $mirayas_item ) : ?>
				<li class="breadcrumbs__item">
					<?php if ( $mirayas_index < $mirayas_last && ! empty( $mirayas_item[1] ) ) : ?>
						<a class="breadcrumbs__link" href="<?php echo esc_url( $mirayas_item[1] ); ?>"><?php echo esc_html( $mirayas_item[0] ); ?></a>
						<?php mirayas_the_icon( 'chevron-right', 14 ); ?>
					<?php else : ?>
						<span class="breadcrumbs__current" aria-current="page"><?php echo esc_html( $mirayas_item[0] ); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</nav>
	<?php
}

/**
 * Render archive pagination.
 */
function mirayas_the_pagination() {
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => mirayas_get_icon( 'arrow-left' ) . '<span class="pagination__label">' . esc_html__( 'Newer stories', 'mirayas-decor' ) . '</span>',
			'next_text' => '<span class="pagination__label">' . esc_html__( 'Older stories', 'mirayas-decor' ) . '</span>' . mirayas_get_icon( 'arrow-right' ),
		)
	);
}

/**
 * Customizer defaults. Single source of truth for every setting the theme
 * registers (see inc/customizer.php); templates pass mirayas_default() as
 * the fallback to get_theme_mod().
 *
 * @param string $key Setting key.
 * @return mixed
 */
function mirayas_default( $key ) {
	$mirayas_defaults = apply_filters(
		'mirayas_defaults',
		array(
			'announcement_text' => __( 'Free shipping across India on orders over ₹2,500.', 'mirayas-decor' ),
			'announcement_show' => true,
			'hero_eyebrow'      => __( 'New arrivals', 'mirayas-decor' ),
			'hero_title'        => __( 'Curated decor for considered homes.', 'mirayas-decor' ),
			'hero_text'         => __( 'Hand-finished pieces made in small batches — textiles, ceramics, lighting and objects that make a house feel like yours.', 'mirayas-decor' ),
			'hero_button_text'  => __( 'Shop new arrivals', 'mirayas-decor' ),
			'collections_title' => __( 'Shop by room', 'mirayas-decor' ),
			'editorial_title'   => __( 'From the journal', 'mirayas-decor' ),
			'trust_item_1'      => __( 'Free shipping over ₹2,500', 'mirayas-decor' ),
			'trust_item_2'      => __( '15-day easy returns', 'mirayas-decor' ),
			'trust_item_3'      => __( 'Secure payments', 'mirayas-decor' ),
			'trust_item_4'      => __( 'Sustainably sourced materials', 'mirayas-decor' ),
			'newsletter_title'  => __( 'Join the inner circle', 'mirayas-decor' ),
			'newsletter_text'   => __( 'Be first to see new collections, and receive 10% off your first order.', 'mirayas-decor' ),
			'footer_copyright'  => '© %year% %site%. All rights reserved.',
		)
	);

	return isset( $mirayas_defaults[ $key ] ) ? $mirayas_defaults[ $key ] : '';
}

/**
 * Strip the "Category:" style prefixes from archive titles — the page-header
 * component renders its own eyebrow labels.
 *
 * @param string $title Archive title.
 * @return string
 */
function mirayas_archive_title( $title ) {
	if ( is_category() || is_tag() || is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_year() ) {
		$title = get_the_date( _x( 'Y', 'yearly archives date format', 'mirayas-decor' ) );
	} elseif ( is_month() ) {
		$title = get_the_date( _x( 'F Y', 'monthly archives date format', 'mirayas-decor' ) );
	} elseif ( is_day() ) {
		$title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'mirayas-decor' ) );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'mirayas_archive_title' );