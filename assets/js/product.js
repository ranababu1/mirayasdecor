/**
 * Mirayas Decor — product page enhancements.
 *
 * Dependency-free, product pages only. Builds the quantity stepper around
 * every quantity input in the add-to-cart form: the − and + buttons adjust
 * the value within the input's min/max/step and dispatch a native change
 * event, so WooCommerce's own variation and total logic stays in sync.
 *
 * The product gallery is handled entirely by WooCommerce's core scripts —
 * zoom, lightbox and slider support are declared in inc/woocommerce.php.
 *
 * @package Mirayas_Decor
 */

( function () {
	'use strict';

	function buildStepper( input ) {
		if ( ! input || input.closest( '.qty-group' ) ) {
			return; // Already enhanced.
		}

		var group = document.createElement( 'span' );
		group.className = 'qty-group';

		input.parentNode.insertBefore( group, input );
		group.appendChild( input );

		var minus = document.createElement( 'button' );
		minus.type = 'button';
		minus.className = 'qty-step qty-step--minus';
		minus.textContent = '\u2212'; // −

		var plus = document.createElement( 'button' );
		plus.type = 'button';
		plus.className = 'qty-step qty-step--plus';
		plus.textContent = '+';

		group.insertBefore( minus, input );
		group.appendChild( plus );

		function step( direction ) {
			var min = parseFloat( input.min );
			var max = parseFloat( input.max );
			var stepSize = parseFloat( input.step );
			var value = parseFloat( input.value );

			if ( isNaN( stepSize ) || 0 === stepSize ) {
				stepSize = 1;
			}
			if ( isNaN( value ) ) {
				value = isNaN( min ) ? 0 : min;
			}

			value += direction * stepSize;

			if ( ! isNaN( min ) && value < min ) {
				value = min;
			}
			if ( ! isNaN( max ) && value > max ) {
				value = max;
			}

			value = Math.round( value * 100 ) / 100;

			var next = String( value );

			if ( next === input.value ) {
				return; // Clamped; nothing to update.
			}

			input.value = next;
			input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
		}

		minus.addEventListener( 'click', function () {
			step( -1 );
		} );

		plus.addEventListener( 'click', function () {
			step( 1 );
		} );
	}

	function init() {
		document.querySelectorAll( 'form.cart input.qty' ).forEach( buildStepper );
	}

	init();

	/*
	 * Variable products re-render parts of the add-to-cart area as
	 * variations are picked; the observer keeps newly rendered inputs
	 * enhanced without listening to jQuery-only events.
	 */
	var cartForm = document.querySelector( 'form.cart' );

	if ( cartForm && 'MutationObserver' in window ) {
		new MutationObserver( init ).observe( cartForm, { childList: true, subtree: true } );
	}
} )();