<?php
/**
 * The search form, used by get_search_form() and the search dialog.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_id = wp_unique_id( 'mirayas-search-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $mirayas_id ); ?>">
		<?php esc_html_e( 'Search for:', 'mirayas-decor' ); ?>
	</label>
	<div class="search-form__fields">
		<input
			type="search"
			id="<?php echo esc_attr( $mirayas_id ); ?>"
			class="search-form__input"
			placeholder="<?php esc_attr_e( 'Search products and stories', 'mirayas-decor' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
		/>
		<button type="submit" class="search-form__submit button button--primary" aria-label="<?php esc_attr_e( 'Search', 'mirayas-decor' ); ?>">
			<?php mirayas_the_icon( 'search' ); ?>
			<span class="search-form__hint"><?php esc_html_e( 'Search', 'mirayas-decor' ); ?></span>
		</button>
	</div>
</form>