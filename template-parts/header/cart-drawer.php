<?php
/**
 * The cart drawer: a native <dialog> showing the WooCommerce mini cart.
 * The wrapper carries the widget_shopping_cart classes so WooCommerce's own
 * cart fragments keep the contents live after every add-to-cart.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

if ( ! mirayas_has_woocommerce() ) {
	return;
}
?>
<dialog id="cart-drawer" class="drawer drawer--cart" data-mirayas-dialog aria-label="<?php esc_attr_e( 'Shopping cart', 'mirayas-decor' ); ?>">
	<div class="drawer__panel">
		<div class="drawer__head">
			<span class="drawer__title"><?php esc_html_e( 'Your cart', 'mirayas-decor' ); ?></span>
			<button
				type="button"
				class="drawer__close"
				data-mirayas-close
				aria-label="<?php esc_attr_e( 'Close cart', 'mirayas-decor' ); ?>"
			>
				<?php mirayas_the_icon( 'close' ); ?>
			</button>
		</div>

		<div class="drawer__body">
			<div class="widget_shopping_cart">
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
		</div>
	</div>
</dialog>