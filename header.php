<?php
/**
 * The theme header.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
wp_body_open();
?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mirayas-decor' ); ?></a>

<div id="page" class="site">

	<?php get_template_part( 'template-parts/header/announcement-bar' ); ?>

	<header id="masthead" class="site-header" data-mirayas-header>
		<div class="container site-header__inner">
			<?php
			get_template_part( 'template-parts/header/branding' );
			get_template_part( 'template-parts/header/navigation' );
			get_template_part( 'template-parts/header/actions' );
			?>
		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * Native <dialog> drawers: navigation, cart and search. Hidden by default,
	 * opened with showModal() from assets/js/navigation.js.
	 */
	get_template_part( 'template-parts/header/nav-drawer' );
	get_template_part( 'template-parts/header/cart-drawer' );
	get_template_part( 'template-parts/header/search-dialog' );
	?>