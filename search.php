<?php
/**
 * The search results template.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_results = (int) $GLOBALS['wp_query']->found_posts;

get_header();
?>

<main id="content" class="site-main">

	<?php
	get_template_part(
		'template-parts/components/page-header',
		null,
		array(
			'title' => sprintf(
				/* translators: %s: search query. */
				esc_html__( 'Search results for &ldquo;%s&rdquo;', 'mirayas-decor' ),
				get_search_query()
			),
			'subtitle' => sprintf(
				/* translators: %s: number of results. */
				esc_html( _n( '%s result found', '%s results found', $mirayas_results, 'mirayas-decor' ) ),
				esc_html( number_format_i18n( $mirayas_results ) )
			),
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