<?php
/**
 * My Account dashboard. A premium welcome panel with quick links to the
 * account endpoints, ending with the standard dashboard hook so plugins
 * can still attach content.
 *
 * @package Mirayas_Decor
 *
 * @see https://woocommerce.com/document/template-structure/
 */

defined( 'ABSPATH' ) || exit;

$mirayas_user = get_user_by( 'id', get_current_user_id() );

if ( $mirayas_user ) :
	$mirayas_first = $mirayas_user->first_name ? $mirayas_user->first_name : $mirayas_user->display_name;
	?>
	<div class="account-dashboard">

		<div class="account-dashboard__welcome">
			<p class="account-dashboard__eyebrow"><?php esc_html_e( 'My account', 'mirayas-decor' ); ?></p>
			<h2 class="account-dashboard__title">
				<?php
				printf(
					/* translators: %s: customer first name or display name. */
					esc_html__( 'Welcome back, %s', 'mirayas-decor' ),
					esc_html( $mirayas_first )
				);
				?>
			</h2>
			<p class="account-dashboard__text">
				<?php
				printf(
					/* translators: %s: customer display name. */
					esc_html__( 'Hello %s! From here you can review recent orders, manage addresses and update your account details.', 'mirayas-decor' ),
					esc_html( $mirayas_user->display_name )
				);
				?>
			</p>
		</div>

		<div class="account-dashboard__tiles">
			<a class="account-dashboard__tile" href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
				<span class="account-dashboard__tile-icon" aria-hidden="true"><?php mirayas_the_icon( 'package' ); ?></span>
				<span class="account-dashboard__tile-name"><?php esc_html_e( 'Orders', 'mirayas-decor' ); ?></span>
				<span class="account-dashboard__tile-hint"><?php esc_html_e( 'Track and review purchases', 'mirayas-decor' ); ?></span>
			</a>

			<a class="account-dashboard__tile" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>">
				<span class="account-dashboard__tile-icon" aria-hidden="true"><?php mirayas_the_icon( 'truck' ); ?></span>
				<span class="account-dashboard__tile-name"><?php esc_html_e( 'Addresses', 'mirayas-decor' ); ?></span>
				<span class="account-dashboard__tile-hint"><?php esc_html_e( 'Shipping and billing details', 'mirayas-decor' ); ?></span>
			</a>

			<a class="account-dashboard__tile" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">
				<span class="account-dashboard__tile-icon" aria-hidden="true"><?php mirayas_the_icon( 'account' ); ?></span>
				<span class="account-dashboard__tile-name"><?php esc_html_e( 'Account details', 'mirayas-decor' ); ?></span>
				<span class="account-dashboard__tile-hint"><?php esc_html_e( 'Name, email and password', 'mirayas-decor' ); ?></span>
			</a>
		</div>

		<p class="account-dashboard__logout">
			<a class="account-dashboard__logout-link" href="<?php echo esc_url( wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>">
				<?php esc_html_e( 'Log out', 'mirayas-decor' ); ?>
			</a>
		</p>

	</div>

	<?php
endif;

/**
 * Hook: woocommerce_account_dashboard.
 *
 * @hooked woocommerce_account_dashboard - 10 (third-party integrations)
 */
do_action( 'woocommerce_account_dashboard' );