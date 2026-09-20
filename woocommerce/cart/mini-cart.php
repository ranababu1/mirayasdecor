<?php
/**
 * The mini cart contents, used by the cart drawer and refreshed by
 * WooCommerce's own cart fragments. The wrapper classes
 * (widget_shopping_cart_content) are provided by the drawer template and
 * must stay intact for the fragment system.
 *
 * The data-mirayas-cart-count attribute feeds the header cart badge via
 * assets/js/cart.js.
 *
 * @package Mirayas_Decor
 *
 * @see https://woocommerce.com/document/template-structure/
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' );

$mirayas_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;

if ( ! WC()->cart || WC()->cart->is_empty() ) :
	?>
	<p class="woocommerce-mini-cart__empty-message" data-mirayas-cart-count="0">
		<?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?>
	</p>
	<?php
else :
	?>
	<ul class="woocommerce-mini-cart cart_list product_list_widget mini-cart__list" data-mirayas-cart-count="<?php echo esc_attr( $mirayas_count ); ?>">

		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( array_reverse( WC()->cart->get_cart() ) as $mirayas_key => $mirayas_item ) {
			$mirayas_product = apply_filters( 'woocommerce_cart_item_product', $mirayas_item['data'], $mirayas_item, $mirayas_key );
			$mirayas_id      = apply_filters( 'woocommerce_cart_item_product_id', $mirayas_item['product_id'], $mirayas_item, $mirayas_key );

			if ( $mirayas_product && $mirayas_product->exists() && $mirayas_item['quantity'] > 0 ) {
				$mirayas_name       = apply_filters( 'woocommerce_cart_item_name', $mirayas_product->get_name(), $mirayas_item, $mirayas_key );
				$mirayas_thumb      = apply_filters( 'woocommerce_cart_item_thumbnail', $mirayas_product->get_image( 'mirayas-card' ), $mirayas_item, $mirayas_key );
				$mirayas_price      = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $mirayas_product ), $mirayas_item, $mirayas_key );
				$mirayas_permalink  = apply_filters( 'woocommerce_cart_item_permalink', $mirayas_product->is_visible() ? $mirayas_product->get_permalink( $mirayas_item ) : '', $mirayas_item, $mirayas_key );
				$mirayas_qty_markup = apply_filters(
					'woocommerce_widget_cart_item_quantity',
					'<span class="quantity">' . sprintf( '%s &times; %s', $mirayas_item['quantity'], $mirayas_price ) . '</span>',
					$mirayas_item,
					$mirayas_key
				);
				?>
				<li class="woocommerce-mini-cart-item mini-cart__item <?php echo esc_attr( $mirayas_item['quantity'] > 1 ? 'has-multiple' : '' ); ?>">
					<span class="mini-cart-item__media">
						<?php
						if ( $mirayas_permalink ) {
							printf(
								'<a href="%s" tabindex="-1" aria-hidden="true">%s</a>',
								esc_url( $mirayas_permalink ),
								$mirayas_thumb // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							);
						} else {
							echo $mirayas_thumb; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</span>

					<span class="mini-cart-item__body">
						<?php
						if ( $mirayas_permalink ) {
							printf(
								'<a class="mini-cart-item__name" href="%s">%s</a>',
								esc_url( $mirayas_permalink ),
								wp_kses_post( $mirayas_name )
							);
						} else {
							echo wp_kses_post( $mirayas_name );
						}
						?>
						<?php echo wp_kses_post( $mirayas_qty_markup ); ?>
					</span>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_after_mini_cart_contents' );
		?>
	</ul>

	<p class="woocommerce-mini-cart__total total mini-cart__total">
		<span class="mini-cart__total-label"><?php esc_html_e( 'Subtotal:', 'woocommerce' ); ?></span>
		<?php echo WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="woocommerce-mini-cart__buttons buttons mini-cart__buttons">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button button--secondary wc-forward">
			<?php esc_html_e( 'View cart', 'woocommerce' ); ?>
		</a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button button--primary checkout wc-forward">
			<?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
		</a>
	</p>
	<?php
endif;

do_action( 'woocommerce_after_mini_cart' );