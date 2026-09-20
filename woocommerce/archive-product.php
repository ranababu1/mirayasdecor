<?php
/**
 * The shop and product taxonomy archive. Replaces the default WooCommerce
 * template so the page uses the theme's page-header and own container.
 *
 * Standard shop hooks are preserved (notices, result count, ordering,
 * loop, pagination) so plugins and child themes keep working.
 *
 * @package Mirayas_Decor
 *
 * @see https://woocommerce.com/document/template-structure/
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="content" class="site-main site-main--shop">

	<?php
	get_template_part(
		'template-parts/components/page-header',
		null,
		array(
			'title' => woocommerce_page_title( false ),
			'align' => 'left',
		)
	);
	?>

	<div class="container shop-layout">

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php do_action( 'woocommerce_before_shop_loop' ); ?>

		<?php if ( woocommerce_product_loop() ) : ?>

			<?php
			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();
			?>

			<?php do_action( 'woocommerce_after_shop_loop' ); ?>

		<?php else : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	</div><!-- .container -->

</main><!-- #content -->

<?php
get_footer();