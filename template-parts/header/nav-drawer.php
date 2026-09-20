<?php
/**
 * The navigation drawer: a native <dialog> holding the primary menu on
 * small screens. Opened via showModal() from assets/js/navigation.js.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

if ( ! has_nav_menu( 'primary' ) ) {
	return;
}
?>
<dialog id="nav-drawer" class="drawer drawer--nav" data-mirayas-dialog aria-label="<?php esc_attr_e( 'Menu', 'mirayas-decor' ); ?>">
	<div class="drawer__panel">
		<div class="drawer__head">
			<span class="drawer__title"><?php bloginfo( 'name' ); ?></span>
			<button
				type="button"
				class="drawer__close"
				data-mirayas-close
				aria-label="<?php esc_attr_e( 'Close menu', 'mirayas-decor' ); ?>"
			>
				<?php mirayas_the_icon( 'close' ); ?>
			</button>
		</div>

		<div class="drawer__body">
			<nav class="drawer__nav" aria-label="<?php esc_attr_e( 'Mobile menu', 'mirayas-decor' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'drawer__menu',
						'depth'          => 2,
					)
				);
				?>
			</nav>
		</div>

		<?php if ( mirayas_has_woocommerce() ) : ?>
			<div class="drawer__foot">
				<a class="drawer__foot-link" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
					<?php mirayas_the_icon( 'account' ); ?>
					<span><?php esc_html_e( 'My account', 'mirayas-decor' ); ?></span>
				</a>
				<a class="drawer__foot-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<?php mirayas_the_icon( 'cart' ); ?>
					<span><?php esc_html_e( 'Cart', 'mirayas-decor' ); ?></span>
				</a>
			</div>
		<?php endif; ?>
	</div>
</dialog>