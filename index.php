<?php
/**
 * The main template file. Used as the fallback for any view without a more
 * specific template in the template hierarchy.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="content" class="site-main">

	<div class="container">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_singular() ) : ?>

				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'single' );
				endwhile;
				?>

			<?php else : ?>

				<div class="post-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', get_post_type() );
					endwhile;
					?>
				</div><!-- .post-grid -->

				<?php mirayas_the_pagination(); ?>

			<?php endif; ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- .container -->

</main><!-- #content -->

<?php
get_footer();