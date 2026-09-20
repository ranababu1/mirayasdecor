<?php
/**
 * The post card: a journal story tile used in archives, search results and
 * the Journal grid. Works for posts and custom post types alike.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'post-card' ); ?>>
	<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail(
				'mirayas-card',
				array(
					'class'    => 'post-card__image',
					'loading'  => 'lazy',
					'decoding' => 'async',
				)
			);
		} else {
			mirayas_the_placeholder();
		}
		?>
	</a>

	<div class="post-card__body">
		<?php $mirayas_categories = get_the_category_list( ', ' ); ?>
		<?php if ( $mirayas_categories ) : ?>
			<p class="post-card__kicker"><?php echo wp_kses_post( $mirayas_categories ); ?></p>
		<?php endif; ?>

		<h2 class="post-card__title">
			<a class="post-card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<p class="post-card__meta">
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</p>

		<?php if ( has_excerpt() ) : ?>
			<p class="post-card__excerpt">
				<?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?>
			</p>
		<?php endif; ?>
	</div>
</article>