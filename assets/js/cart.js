/**
 * Mirayas Decor — cart behaviour.
 *
 * The one jQuery-dependent script: it listens to WooCommerce's jQuery
 * `added_to_cart` / `removed_from_cart` events and reacts by refreshing the
 * cart drawer from the event's cart fragments, syncing the header cart badge
 * (.site-header__cart-count, marked .is-empty when the count is zero) and
 * opening the drawer through navigation.js ("mirayas:open-dialog").
 *
 * Fragments are applied from the event arguments, which is idempotent even
 * when WooCommerce's own scripts have applied them already — the count
 * source is the data-mirayas-cart-count attribute rendered by mini-cart.php.
 *
 * @package Mirayas_Decor
 */

( function ( $ ) {
	'use strict';

	/**
	 * Replace the cart drawer contents with the widget fragment, if provided.
	 *
	 * @param {Object} fragments Cart fragments (selector -> markup).
	 */
	function applyFragment( fragments ) {
		if ( ! fragments ) {
			return;
		}

		Object.keys( fragments ).forEach( function ( selector ) {
			if ( selector.indexOf( 'widget_shopping_cart_content' ) === -1 ) {
				return;
			}

			var holder = document.createElement( 'div' );
			holder.innerHTML = fragments[ selector ];

			var replacement = holder.firstElementChild;
			var current = document.querySelector( '#cart-drawer .widget_shopping_cart_content' );

			if ( replacement && current ) {
				current.replaceWith( replacement );
			}
		} );
	}

	/**
	 * Mirror the cart count from the drawer onto the header badge.
	 */
	function syncBadge() {
		var source = document.querySelector( '#cart-drawer [data-mirayas-cart-count]' );
		var badge = document.querySelector( '.site-header__cart-count' );

		if ( ! source || ! badge ) {
			return;
		}

		var count = parseInt( source.getAttribute( 'data-mirayas-cart-count' ), 10 ) || 0;
		var text = String( count );

		badge.textContent = text;
		badge.setAttribute( 'data-mirayas-cart-count', text );
		badge.classList.toggle( 'is-empty', 0 === count );
	}

	/** Open the cart drawer through navigation.js. */
	function openCartDrawer() {
		document.dispatchEvent( new CustomEvent( 'mirayas:open-dialog', { detail: { id: 'cart-drawer' } } ) );
	}

	$( function () {
		syncBadge();
	} );

	$( document.body ).on( 'added_to_cart', function ( event, fragments ) {
		applyFragment( fragments );
		syncBadge();
		openCartDrawer();
	} );

	$( document.body ).on( 'removed_from_cart', function ( event, fragments ) {
		applyFragment( fragments );
		syncBadge();
	} );

	$( document.body ).on( 'wc_fragments_refreshed wc_fragments_added', syncBadge );
} )( jQuery );