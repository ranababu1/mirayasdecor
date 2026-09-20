<?php
/**
 * Front section: shop-by-room collection tiles built from the top-level
 * product categories. Category images come from WooCommerce's term
 * thumbnail; categories without one get the SVG placeholder.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

if ( ! mirayas_has_woocommerce() ) {
	return;
}

$mirayas_terms = get_terms(
	apply_filters(
		'mirayas_collections_args',
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => 0,
			'number'     => 4,
			'hide_empty' => true,
			'orderby'    => 'count',
			'order'      => 'DESC',
		)
	)
);

if ( is_wp_error( $mirayas_terms ) || empty( $mirayas_terms ) ) {
	return;
}

$mirayas_title = get_theme_mod( 'mirayas_collections_title', mirayas_default( 'collections_title' ) );
?>
<section class="front-section collections">
	<div class="container">
		<div class="front-section__head front-section__head--center">
			<h2 class="front-section__title"><?php echo esc_html( $mirayas_title ); ?></h2>
		</div>

		<div class="collections__grid">
			<?php foreach ( $mirayas_terms as $mirayas_term ) : ?>
				<?php
				$mirayas_thumbnail_id = (int) get_term_meta( $mirayas_term->term_id, 'thumbnail_id', true );

				$mirayas_count_text = sprintf(
					/* translators: %s: number of products in the category. */
					_n( '%s piece', '%s pieces', $mirayas_term->count, 'mirayas-decor' ),
					number_format_i18n( $mirayas_term->count )
				);
				?>
				<a class="collection-tile" href="<?php echo esc_url( get_term_link( $mirayas_term ) ); ?>">
					<span class="collection-tile__media">
						<?php
						if ( $mirayas_thumbnail_id ) {
							echo wp_get_attachment_image(
								$mirayas_thumbnail_id,
								'mirayas-card',
								false,
								array(
									'class'    => 'collection-tile__image',
									'loading'  => 'lazy',
									'decoding' => 'async',
								)
							);
						} else {
							mirayas_the_placeholder();
						}
						?>
					</span>
					<span class="collection-tile__label">
						<span class="collection-tile__name"><?php echo esc_html( $mirayas_term->name ); ?></span>
						<span class="collection-tile__count"><?php echo esc_html( $mirayas_count_text ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>