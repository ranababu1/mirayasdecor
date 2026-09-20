<?php
/**
 * Payment icons: text badges for the checkout methods an Indian store runs.
 * Trademarked logos are intentionally not embedded as images.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_methods = apply_filters(
	'mirayas_payment_methods',
	array( 'UPI', 'Visa', 'Mastercard', 'RuPay', 'Net Banking', 'COD' )
);
?>
<div class="payment-icons">
	<span class="screen-reader-text">
		<?php
		printf(
			/* translators: %s: comma-separated list of payment methods. */
			esc_html__( 'Accepted payment methods: %s', 'mirayas-decor' ),
			esc_html( implode( ', ', $mirayas_methods ) )
		);
		?>
	</span>

	<?php foreach ( $mirayas_methods as $mirayas_method ) : ?>
		<span class="payment-icons__item" aria-hidden="true">
			<?php echo esc_html( $mirayas_method ); ?>
		</span>
	<?php endforeach; ?>
</div>