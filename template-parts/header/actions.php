<?php
/**
 * Header actions: search, account, cart and the mobile menu toggle.
 *
 * The cart toggle is a link to the cart page that JavaScript intercepts to
 * open the cart drawer instead — visitors without JavaScript still land on
 * the full cart page.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="site-header__actions">
	<button
		type="button"
		class="site-header__action"
		data-mirayas-open="search-dialog"
		aria-label="<?php esc_attr_e( 'Search', 'mirayas-decor' ); ?>"
	>
		<?php mirayas_the_icon( 'search' ); ?>
	</button>

	<?php if ( mirayas_has_woocommerce() ) : ?>
		<a
			class="site-header__action"
			href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
		>
			<?php mirayas_the_icon( 'account' ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'My account', 'mirayas-decor' ); ?></span>
		</a>

		<?php if ( null !== WC()->cart ) : ?>
			<a
				class="site-header__action site-header__action--cart"
				href="<?php echo esc_url( wc_get_cart_url() ); ?>"
				data-mirayas-open="cart-drawer"
				aria-label="<?php esc_attr_e( 'View cart', 'mirayas-decor' ); ?>"
			>
				<?php mirayas_the_icon( 'cart' ); ?>
				<?php $mirayas_cart_count = (int) WC()->cart->get_cart_contents_count(); ?>
				<span
					class="site-header__cart-count<?php echo 0 === $mirayas_cart_count ? ' is-empty' : ''; ?>"
					data-mirayas-cart-count
				>
					<?php echo esc_html( $mirayas_cart_count ); ?>
				</span>
			</a>
		<?php endif; ?>
	<?php endif; ?>

	<button
		type="button"
		class="site-header__action site-header__action--menu"
		data-mirayas-open="nav-drawer"
		aria-label="<?php esc_attr_e( 'Open menu', 'mirayas-decor' ); ?>"
	>
		<?php mirayas_the_icon( 'menu' ); ?>
	</button>
</div>