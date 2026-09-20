<?php
/**
 * The archive template (category, tag, author and date archives).
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="content" class="site-main">

	<?php
	get_template_part(
		'template-parts/components/page-header',
		null,
		array(
			'title'    => get_the_archive_title(),
			'subtitle' => wp_strip_all_tags( get_the_archive_description() ),
			'align'    => 'center',
		)
	);
	?>

	<div class="container">

		<?php if ( have_posts() ) : ?>

			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/components/post-card' );
				endwhile;
				?>
			</div><!-- .post-grid -->

			<?php mirayas_the_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- .container -->

</main><!-- #content -->

<?php
get_footer();