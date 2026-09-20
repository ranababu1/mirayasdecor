<?php
/**
 * Front section: the Journal — the three most recent stories.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_query = new WP_Query(
	apply_filters(
		'mirayas_editorial_query_args',
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	)
);

if ( ! $mirayas_query->have_posts() ) {
	return;
}

$mirayas_title = get_theme_mod( 'mirayas_editorial_title', mirayas_default( 'editorial_title' ) );

$mirayas_journal_page = (int) get_option( 'page_for_posts' );
$mirayas_journal_url  = $mirayas_journal_page ? get_permalink( $mirayas_journal_page ) : home_url( '/' );
?>
<section class="front-section editorial">
	<div class="container">
		<div class="front-section__head">
			<h2 class="front-section__title"><?php echo esc_html( $mirayas_title ); ?></h2>
			<a class="front-section__link" href="<?php echo esc_url( $mirayas_journal_url ); ?>">
				<span><?php esc_html_e( 'Read the journal', 'mirayas-decor' ); ?></span>
				<?php mirayas_the_icon( 'arrow-right' ); ?>
			</a>
		</div>

		<div class="post-grid">
			<?php
			while ( $mirayas_query->have_posts() ) :
				$mirayas_query->the_post();
				get_template_part( 'template-parts/components/post-card' );
			endwhile;

			wp_reset_postdata();
			?>
		</div>
	</div>
</section>