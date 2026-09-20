<?php
/**
 * Front section: the brand story. Editorial split layout with a framed
 * image on one side and slow-living copy on the other.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="front-section story">
	<div class="container story__inner">

		<figure class="story__media">
			<?php mirayas_the_placeholder(); ?>
			<figcaption class="story__caption">
				<?php esc_html_e( 'The Mirayas atelier — Jodhpur, India', 'mirayas-decor' ); ?>
			</figcaption>
		</figure>

		<div class="story__body">
			<p class="story__eyebrow"><?php esc_html_e( 'Our story', 'mirayas-decor' ); ?></p>

			<h2 class="story__title">
				<?php esc_html_e( 'Made slowly, in small batches, made to last.', 'mirayas-decor' ); ?>
			</h2>

			<p class="story__text">
				<?php esc_html_e( 'Mirayas Decor began with a simple conviction: a home is not furnished, it is composed. Every piece we offer is shaped by artisans whose families have worked with mango wood, handloom cotton and brass for generations.', 'mirayas-decor' ); ?>
			</p>

			<p class="story__text">
				<?php esc_html_e( 'We keep production runs deliberately small, finish every surface by hand, and choose materials that age with grace. The result is furniture and decor that quietly outlives trends — and often us.', 'mirayas-decor' ); ?>
			</p>

			<p class="story__sign"><?php esc_html_e( '— The Mirayas atelier', 'mirayas-decor' ); ?></p>
		</div>
	</div>
</section>