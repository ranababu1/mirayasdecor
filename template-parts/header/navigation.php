<?php
/**
 * Primary navigation. Desktop only; small screens use the nav drawer.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

if ( ! has_nav_menu( 'primary' ) ) {
	return;
}
?>
<nav class="site-navigation" data-mirayas-nav aria-label="<?php esc_attr_e( 'Primary menu', 'mirayas-decor' ); ?>">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'site-navigation__list',
			'depth'          => 2,
		)
	);
	?>
</nav>