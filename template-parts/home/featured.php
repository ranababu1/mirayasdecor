<?php
/**
 * Front section: featured products, rendered through the WooCommerce
 * product loop so visibility rules and caching behave like the shop.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

if ( ! mirayas_has_woocommerce() ) {
	return;
}

$mirayas_args = apply_filters(
	'mirayas_featured_products_args',
	array(
		'limit'   => 4,
		'columns' => 4,
		'orderby' => 'popularity',
		'order'   => 'DESC',
	)
);

$mirayas_products = new WC_Shortcode_Products( $mirayas_args );
?>
<section class="front-section featured">
	<div class="container">
		<div class="front-section__head">
			<h2 class="front-section__title"><?php esc_html_e( 'Featured pieces', 'mirayas-decor' ); ?></h2>
			<a class="front-section__link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
				<span><?php esc_html_e( 'View all', 'mirayas-decor' ); ?></span>
				<?php mirayas_the_icon( 'arrow-right' ); ?>
			</a>
		</div>

		<?php echo $mirayas_products->get_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce loop markup. ?>
	</div>
</section>