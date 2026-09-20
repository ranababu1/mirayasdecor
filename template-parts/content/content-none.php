<?php
/**
 * No-content state for empty archives and empty search results.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

if ( is_search() ) {
	$mirayas_state = array(
		'icon'    => 'search',
		'eyebrow' => __( 'No matches', 'mirayas-decor' ),
		'title'   => __( 'Nothing found for that search', 'mirayas-decor' ),
		'text'    => __( 'Check the spelling or try a broader phrase — or browse the collections for inspiration.', 'mirayas-decor' ),
		'actions' => array(),
		'search'  => true,
	);

	if ( mirayas_has_woocommerce() ) {
		$mirayas_state['actions'][] = array(
			'label'   => __( 'Browse the shop', 'mirayas-decor' ),
			'url'     => wc_get_page_permalink( 'shop' ),
			'primary' => true,
		);
	}
} else {
	$mirayas_state = array(
		'icon'    => 'package',
		'eyebrow' => __( 'Coming soon', 'mirayas-decor' ),
		'title'   => __( 'Nothing published here yet', 'mirayas-decor' ),
		'text'    => __( 'New pieces are being prepared. Head back to the homepage to see the latest.', 'mirayas-decor' ),
		'actions' => array(
			array(
				'label'   => __( 'Go to homepage', 'mirayas-decor' ),
				'url'     => home_url( '/' ),
				'primary' => true,
			),
		),
		'search'  => false,
	);
}

get_template_part( 'template-parts/components/empty-state', null, $mirayas_state );