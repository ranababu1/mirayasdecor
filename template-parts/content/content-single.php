<?php
/**
 * Single post content: the journal story layout.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'entry entry--single' ); ?>>

	<header class="entry__header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<?php $mirayas_categories = get_the_category_list( ', ' ); ?>
			<?php if ( $mirayas_categories ) : ?>
				<p class="entry__kicker"><?php echo wp_kses_post( $mirayas_categories ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<h1 class="entry__title"><?php the_title(); ?></h1>

		<p class="entry__meta">
			<?php
			printf(
				/* translators: %s: post date, already localized. */
				esc_html__( 'Published %s', 'mirayas-decor' ),
				'<time datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>'
			);
			?>
			<?php
			if ( get_the_author() ) {
				printf(
					/* translators: %s: author name. */
					esc_html__( ' by %s', 'mirayas-decor' ),
					esc_html( get_the_author() )
				);
			}
			?>
		</p>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry__media">
				<?php
				the_post_thumbnail(
					'mirayas-wide',
					array(
						'class'    => 'entry__image',
						'loading'  => 'eager',
						'fetchpriority' => 'high',
						'decoding' => 'async',
					)
				);
				?>
			</figure>
		<?php endif; ?>
	</header>

	<div class="entry__content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<nav class="entry__pages">',
				'after'  => '</nav>',
			)
		);
		?>
	</div>

	<?php $mirayas_tags = get_the_tag_list( '', ' ' ); ?>
	<?php if ( $mirayas_tags ) : ?>
		<footer class="entry__footer">
			<p class="entry__tags">
				<span class="entry__tags-label"><?php esc_html_e( 'Tagged', 'mirayas-decor' ); ?></span>
				<?php echo wp_kses_post( $mirayas_tags ); ?>
			</p>
		</footer>
	<?php endif; ?>
</article>