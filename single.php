<?php
/**
 * The single post (journal story) template.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<main id="content" class="site-main site-main--single">

		<div class="container container--narrow">

			<?php mirayas_breadcrumbs(); ?>

			<?php get_template_part( 'template-parts/content/content', 'single' ); ?>

			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="post-nav__label">' . esc_html__( 'Previous story', 'mirayas-decor' ) . '</span><span class="post-nav__title">%title</span>',
					'next_text' => '<span class="post-nav__label">' . esc_html__( 'Next story', 'mirayas-decor' ) . '</span><span class="post-nav__title">%title</span>',
				)
			);

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>

		</div><!-- .container -->

	</main><!-- #content -->

	<?php
endwhile;

get_footer();