<?php
/**
 * The order-received (thank you) view, rendered by the checkout shortcode.
 * Keeps the canonical notice classes and hooks while wrapping the details
 * in the theme's confirmation presentation.
 *
 * @package Mirayas_Decor
 *
 * @see https://woocommerce.com/document/template-structure/
 *
 * @var WC_Order $order The order being thanked for.
 */

defined( 'ABSPATH' ) || exit;

if ( ! $order ) {
	return;
}
?>
<div class="woocommerce-order thankyou">

	<?php do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-notice woocommerce-notice--error woocommerce-error">
			<?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank or merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?>
		</p>

		<p class="thankyou__retry">
			<a class="button button--primary" href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>">
				<?php esc_html_e( 'Try again', 'woocommerce' ); ?>
			</a>
			<?php if ( wc_get_page_permalink( 'myaccount' ) ) : ?>
				<a class="button button--secondary" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
					<?php esc_html_e( 'My account', 'mirayas-decor' ); ?>
				</a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<div class="thankyou__hero">
			<span class="thankyou__badge" aria-hidden="true">
				<?php mirayas_the_icon( 'check', 32 ); ?>
			</span>
			<h2 class="thankyou__title">
				<?php esc_html_e( 'Thank you — your order is confirmed.', 'mirayas-decor' ); ?>
			</h2>
			<p class="thankyou__text">
				<?php esc_html_e( 'A confirmation email is on its way. We will be in touch as soon as your pieces leave the atelier.', 'mirayas-decor' ); ?>
			</p>
		</div>

		<ul class="woocommerce-thankyou-order-details order_details thankyou__details">
			<li class="thankyou__detail">
				<span class="thankyou__detail-label"><?php esc_html_e( 'Order number:', 'woocommerce' ); ?></span>
				<span class="thankyou__detail-value"><?php echo esc_html( $order->get_order_number() ); ?></span>
			</li>
			<li class="thankyou__detail">
				<span class="thankyou__detail-label"><?php esc_html_e( 'Date:', 'woocommerce' ); ?></span>
				<span class="thankyou__detail-value">
					<time datetime="<?php echo esc_attr( $order->get_date_created() ? $order->get_date_created()->date( 'c' ) : '' ); ?>">
						<?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?>
					</time>
				</span>
			</li>
			<li class="thankyou__detail">
				<span class="thankyou__detail-label"><?php esc_html_e( 'Email:', 'woocommerce' ); ?></span>
				<span class="thankyou__detail-value"><?php echo esc_html( $order->get_billing_email() ); ?></span>
			</li>
			<li class="thankyou__detail">
				<span class="thankyou__detail-label"><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
				<span class="thankyou__detail-value"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
			</li>
			<?php if ( $order->get_payment_method_title() ) : ?>
				<li class="thankyou__detail">
					<span class="thankyou__detail-label"><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></span>
					<span class="thankyou__detail-value"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
				</li>
			<?php endif; ?>
		</ul>

		<?php if ( wc_get_page_permalink( 'shop' ) ) : ?>
			<p class="thankyou__continue">
				<a class="button button--secondary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
					<?php esc_html_e( 'Continue shopping', 'mirayas-decor' ); ?>
				</a>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

</div>