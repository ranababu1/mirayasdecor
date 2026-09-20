/**
 * Mirayas Decor — global enhancements.
 *
 * Dependency-free. Enhances the default newsletter form rendered by
 * template-parts/home/newsletter.php (data-mirayas-form="newsletter").
 * Newsletter plugins can take the form over entirely via the
 * `mirayas_newsletter_form` hook — this script then finds no matching form
 * and quietly does nothing.
 *
 * @package Mirayas_Decor
 */

( function () {
	'use strict';

	document.addEventListener(
		'submit',
		function ( event ) {
			var form = event.target;

			if ( ! ( form instanceof HTMLFormElement ) || 'newsletter' !== form.getAttribute( 'data-mirayas-form' ) ) {
				return;
			}

			var field = form.querySelector( 'input[type="email"]' );

			if ( ! field ) {
				return;
			}

			event.preventDefault(); // The default form has no server handler.

			if ( ! field.checkValidity() ) {
				field.setAttribute( 'aria-invalid', 'true' );
				field.focus();
				return;
			}

			field.removeAttribute( 'aria-invalid' );

			var note = form.querySelector( '[data-mirayas-note]' );

			if ( note ) {
				note.textContent = note.getAttribute( 'data-mirayas-note' );
				note.setAttribute( 'role', 'status' );
				note.hidden = false;
			}

			form.reset();
			field.focus();
		}
	);
} )();