<?php
/**
 * Empty cart state, rendered inside the Cart page by the [woocommerce_cart]
 * shortcode. Uses the shared empty-state component.
 *
 * @package Mirayas_Decor
 *
 * @see https://woocommerce.com/document/template-structure/
 */

defined( 'ABSPATH' ) || exit;

$mirayas_actions = array();

if ( wc_get_page_permalink( 'shop' ) ) {
	$mirayas_actions[] = array(
		'label'   => __( 'Return to shop', 'mirayas-decor' ),
		'url'     => wc_get_page_permalink( 'shop' ),
		'primary' => true,
	);
}

/**
 * Hook: woocommerce_cart_is_empty.
 */
do_action( 'woocommerce_cart_is_empty' );

get_template_part(
	'template-parts/components/empty-state',
	null,
	array(
		'icon'    => 'cart',
		'eyebrow' => __( 'Empty cart', 'mirayas-decor' ),
		'title'   => __( 'Your cart is waiting to be filled', 'mirayas-decor' ),
		'text'    => __( 'Browse the collections and add the pieces you would like to live with.', 'mirayas-decor' ),
		'actions' => $mirayas_actions,
		'search'  => false,
	)
);