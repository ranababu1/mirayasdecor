<?php
/**
 * The front page. Assembled entirely from theme hooks so every home page
 * section can be added, removed or reordered from a child theme or plugin.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="content" class="site-main site-main--front">

	<?php
	/**
	 * Front page sections. Callbacks are wired in inc/template-hooks.php and
	 * each can be toggled from the Customizer.
	 *
	 * @hooked mirayas_render_front_hero       - 10 - Hero
	 * @hooked mirayas_render_front_featured   - 20 - Featured products
	 * @hooked mirayas_render_front_collections - 30 - Shop-by-room collections
	 * @hooked mirayas_render_front_story      - 40 - Brand story
	 * @hooked mirayas_render_front_editorial  - 50 - Latest journal posts
	 * @hooked mirayas_render_front_trust       - 60 - Trust strip
	 * @hooked mirayas_render_front_newsletter  - 70 - Newsletter panel
	 */
	do_action( 'mirayas_front_hero' );
	do_action( 'mirayas_front_featured' );
	do_action( 'mirayas_front_collections' );
	do_action( 'mirayas_front_story' );
	do_action( 'mirayas_front_editorial' );
	do_action( 'mirayas_front_trust' );
	do_action( 'mirayas_front_newsletter' );
	?>

</main><!-- #content -->

<?php
get_footer();