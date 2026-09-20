<?php
/**
 * The page template.
 *
 * Also renders the WooCommerce cart, checkout and My Account pages, which are
 * standard WordPress pages containing WooCommerce shortcodes. Those get a
 * compact header so the page does not compete with the cart and checkout UI.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_is_woo_page = mirayas_has_woocommerce()
	&& ( is_cart() || is_checkout() || is_account_page() );

get_header();
?>

<main id="content" class="site-main site-main--page">

	<?php
	get_template_part(
		'template-parts/components/page-header',
		null,
		array(
			'title'   => get_the_title(),
			'compact' => $mirayas_is_woo_page,
		)
	);
	?>

	<div class="container<?php echo $mirayas_is_woo_page ? ' container--page' : ''; ?>">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', 'page' );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div><!-- .container -->

</main><!-- #content -->

<?php
get_footer();