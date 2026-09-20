<?php
/**
 * Static page content. The title is rendered by the page-header component.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'entry entry--page' ); ?>>

	<?php if ( has_post_thumbnail() && ! is_page() ) : ?>
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
</article>