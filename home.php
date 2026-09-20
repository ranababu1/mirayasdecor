<?php
/**
 * The blog index (posts page).
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_journal_title = get_the_title( (int) get_option( 'page_for_posts' ) );

if ( ! $mirayas_journal_title ) {
	$mirayas_journal_title = __( 'Journal', 'mirayas-decor' );
}

get_header();
?>

<main id="content" class="site-main">

	<?php
	get_template_part(
		'template-parts/components/page-header',
		null,
		array(
			'title'    => $mirayas_journal_title,
			'subtitle' => get_bloginfo( 'description' ),
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