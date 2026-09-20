<?php
/**
 * The 404 template.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="content" class="site-main site-main--404">

	<div class="container container--narrow">

		<?php
		$mirayas_actions = array(
			array(
				'label'   => __( 'Go to homepage', 'mirayas-decor' ),
				'url'     => home_url( '/' ),
				'primary' => true,
			),
		);

		if ( mirayas_has_woocommerce() ) {
			$mirayas_actions[] = array(
				'label' => __( 'Browse the shop', 'mirayas-decor' ),
				'url'   => wc_get_page_permalink( 'shop' ),
			);
		}

		get_template_part(
			'template-parts/components/empty-state',
			null,
			array(
				'icon'    => 'search',
				'eyebrow' => __( 'Error 404', 'mirayas-decor' ),
				'title'   => __( 'This page has wandered off', 'mirayas-decor' ),
				'text'    => __( 'The page you are looking for may have been moved or no longer exists. Try a search, or head back to the shop.', 'mirayas-decor' ),
				'actions' => $mirayas_actions,
				'search'  => true,
			)
		);
		?>

	</div><!-- .container -->

</main><!-- #content -->

<?php
get_footer();