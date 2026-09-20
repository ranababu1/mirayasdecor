<?php
/**
 * The search dialog: a native <dialog> with the search form and quick links
 * to the most popular shop categories.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_quick = array();

if ( mirayas_has_woocommerce() ) {
	$mirayas_quick = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => 0,
			'number'     => 5,
			'hide_empty' => true,
			'orderby'    => 'count',
			'order'      => 'DESC',
		)
	);

	if ( is_wp_error( $mirayas_quick ) ) {
		$mirayas_quick = array();
	}
}
?>
<dialog id="search-dialog" class="search-dialog" data-mirayas-dialog aria-label="<?php esc_attr_e( 'Search', 'mirayas-decor' ); ?>">
	<div class="search-dialog__inner">
		<div class="search-dialog__head">
			<p class="search-dialog__intro"><?php esc_html_e( 'What are you looking for today?', 'mirayas-decor' ); ?></p>
			<button
				type="button"
				class="search-dialog__close"
				data-mirayas-close
				aria-label="<?php esc_attr_e( 'Close search', 'mirayas-decor' ); ?>"
			>
				<?php mirayas_the_icon( 'close' ); ?>
			</button>
		</div>

		<?php get_search_form(); ?>

		<?php if ( $mirayas_quick ) : ?>
			<p class="search-dialog__hint"><?php esc_html_e( 'Popular right now', 'mirayas-decor' ); ?></p>
			<div class="search-dialog__quick">
				<?php foreach ( $mirayas_quick as $mirayas_term ) : ?>
					<a class="search-dialog__tag" href="<?php echo esc_url( get_term_link( $mirayas_term ) ); ?>">
						<?php echo esc_html( $mirayas_term->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</dialog>