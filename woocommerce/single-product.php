<?php
/**
 * The single product template. Replaces the default WooCommerce template
 * so the product uses the theme's own container; all summary, tab and
 * related-product hooks are kept intact.
 *
 * @package Mirayas_Decor
 *
 * @see https://woocommerce.com/document/template-structure/
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="content" class="site-main site-main--product">

	<div class="container product-layout">

		<?php mirayas_breadcrumbs(); ?>

		<?php
		while ( have_posts() ) :
			the_post();

			global $product;

			if ( ! $product || ! $product->is_visible() ) {
				continue;
			}

			/**
			 * Hook: woocommerce_before_single_product.
			 */
			do_action( 'woocommerce_before_single_product' );
			?>

			<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-single', $product ); ?>>

				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>

				<div class="summary entry-summary">
					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title    - 5
					 * @hooked woocommerce_template_single_rating   - 10
					 * @hooked woocommerce_template_single_price    - 10
					 * @hooked woocommerce_template_single_excerpt  - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta      - 40
					 * @hooked woocommerce_template_single_sharing  - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
				</div>

				<?php
				/**
				 * Hook: woocommerce_after_single_product_summary.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display           - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action( 'woocommerce_after_single_product_summary' );
				?>
			</div><!-- #product-<?php the_ID(); ?> -->

			<?php
			/**
			 * Hook: woocommerce_after_single_product.
			 */
			do_action( 'woocommerce_after_single_product' );

		endwhile;
		?>

	</div><!-- .container -->

</main><!-- #content -->

<?php
get_footer();