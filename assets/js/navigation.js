/**
 * Mirayas Decor — navigation and dialogs.
 *
 * Dependency-free. Manages:
 *  - the sticky header state (.is-stuck),
 *  - the native <dialog> drawers/search: open via [data-mirayas-open],
 *    close via [data-mirayas-close], backdrop clicks and Escape; animated
 *    exit via .is-closing before close(); body scroll lock while open.
 *  - the depth-2 accordion in the navigation drawer.
 *
 * Dialogs are authored in PHP (template-parts/header/*) and hidden by
 * default; everything here is progressive enhancement. cart.js re-uses the
 * opener through the "mirayas:open-dialog" custom event.
 *
 * @package Mirayas_Decor
 */

( function () {
	'use strict';

	var CLOSE_FALLBACK = 320; // ms; covers the 240ms exit animation.
	var reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	/* Sticky header -------------------------------------------------------------- */

	var header = document.querySelector( '[data-mirayas-header]' );

	function updateSticky() {
		if ( header ) {
			header.classList.toggle( 'is-stuck', window.scrollY > 4 );
		}
	}

	var ticking = false;

	window.addEventListener(
		'scroll',
		function () {
			if ( ticking ) {
				return;
			}
			ticking = true;
			window.requestAnimationFrame( function () {
				ticking = false;
				updateSticky();
			} );
		},
		{ passive: true }
	);

	updateSticky();

	/* Body scroll lock ------------------------------------------------------------- */

	var openDialogs = 0;
	var lastFocused = null;

	function lockScroll() {
		if ( 0 === openDialogs ) {
			var scrollbar = window.innerWidth - document.documentElement.clientWidth;
			document.body.style.setProperty( '--mirayas-scrollbar-comp', scrollbar + 'px' );
			document.body.classList.add( 'is-scroll-locked' );
		}
		openDialogs++;
	}

	function unlockScroll() {
		openDialogs = Math.max( 0, openDialogs - 1 );
		if ( 0 === openDialogs ) {
			document.body.classList.remove( 'is-scroll-locked' );
			document.body.style.removeProperty( '--mirayas-scrollbar-comp' );
		}
	}

	/* Dialog lifecycle --------------------------------------------------------------- */

	function openDialog( dialog ) {
		if ( ! dialog || typeof dialog.showModal !== 'function' || dialog.open ) {
			return;
		}

		lastFocused = document.activeElement;
		lockScroll();
		dialog.showModal();

		// The search dialog should land on its input; drawers keep the default.
		var field = dialog.querySelector( 'input[type="search"], input[type="email"], input[type="text"]' );

		if ( field ) {
			field.focus();
		}
	}

	function closeDialog( dialog ) {
		if ( ! dialog || ! dialog.open || dialog.classList.contains( 'is-closing' ) ) {
			return;
		}

		if ( reducedMotion.matches ) {
			dialog.close();
			return;
		}

		var finished = false;

		function finish() {
			if ( finished ) {
				return;
			}
			finished = true;
			dialog.classList.remove( 'is-closing' );
			dialog.close();
		}

		dialog.classList.add( 'is-closing' );
		dialog.addEventListener( 'animationend', finish, { once: true } );
		window.setTimeout( finish, CLOSE_FALLBACK );
	}

	// `close` and `cancel` do not bubble; capture-phase document listeners work.
	document.addEventListener(
		'close',
		function ( event ) {
			if ( event.target instanceof HTMLDialogElement ) {
				unlockScroll();
				if ( lastFocused && document.contains( lastFocused ) ) {
					lastFocused.focus();
				}
				lastFocused = null;
			}
		},
		true
	);

	document.addEventListener(
		'cancel',
		function ( event ) {
			if ( event.target instanceof HTMLDialogElement ) {
				event.preventDefault(); // Replace the instant close with the animated one.
				closeDialog( event.target );
			}
		},
		true
	);

	document.addEventListener(
		'click',
		function ( event ) {
			if ( event.metaKey || event.ctrlKey || event.shiftKey || event.altKey ) {
				return; // Let modified clicks (new tab etc.) run their default.
			}

			var opener = event.target.closest( '[data-mirayas-open]' );

			if ( opener ) {
				var toOpen = document.getElementById( opener.getAttribute( 'data-mirayas-open' ) );

				if ( toOpen ) {
					event.preventDefault();
					openDialog( toOpen );
				}
				return;
			}

			var closer = event.target.closest( '[data-mirayas-close]' );

			if ( closer ) {
				closeDialog( closer.closest( 'dialog' ) );
				return;
			}

			// Clicks on the ::backdrop area target the <dialog> element itself.
			if ( event.target instanceof HTMLDialogElement ) {
				closeDialog( event.target );
			}
		}
	);

	// Programmatic opens (used by cart.js after an add-to-cart event).
	document.addEventListener( 'mirayas:open-dialog', function ( event ) {
		var dialog = document.getElementById( event.detail && event.detail.id );

		openDialog( dialog );
	} );

	/* Drawer navigation accordion ------------------------------------------------------ */

	function initDrawerMenu() {
		var menu = document.querySelector( '.drawer__menu' );

		if ( ! menu ) {
			return;
		}

		menu.querySelectorAll( 'li.menu-item-has-children' ).forEach( function ( item ) {
			var subMenu = item.querySelector( ':scope > .sub-menu' );

			if ( ! subMenu || item.querySelector( '.drawer__submenu-toggle' ) ) {
				return; // Nothing to toggle, or already enhanced.
			}

			if ( ! subMenu.id ) {
				subMenu.id = 'mirayas-submenu-' + ( item.id || Math.floor( Math.random() * 1e6 ) );
			}

			item.classList.add( 'drawer__item' );

			var toggle = document.createElement( 'button' );
			toggle.type = 'button';
			toggle.className = 'drawer__submenu-toggle';
			toggle.setAttribute( 'aria-expanded', 'false' );
			toggle.setAttribute( 'aria-controls', subMenu.id );
			toggle.textContent = '+'; // Rotates to × via CSS when .is-open.

			item.insertBefore( toggle, subMenu );

			toggle.addEventListener( 'click', function () {
				var open = subMenu.classList.toggle( 'is-open' );

				toggle.classList.toggle( 'is-open', open );
				toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			} );
		} );
	}

	initDrawerMenu();
} )();