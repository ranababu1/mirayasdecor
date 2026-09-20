<?php
/**
 * Empty state: the shared "nothing here" presentation for 404s, empty
 * archives and empty search results.
 *
 * @package Mirayas_Decor
 *
 * @var array $args {
 *     @type string $icon    Icon name from mirayas_icons().
 *     @type string $eyebrow Small label above the title.
 *     @type string $title   Heading.
 *     @type string $text    Supporting copy.
 *     @type array  $actions Array of { label, url, primary } link buttons.
 *     @type bool   $search  Whether to show the search form.
 * }
 */

defined( 'ABSPATH' ) || exit;

$mirayas_args = wp_parse_args(
	$args ?? array(),
	array(
		'icon'    => '',
		'eyebrow' => '',
		'title'   => '',
		'text'    => '',
		'actions' => array(),
		'search'  => false,
	)
);
?>
<div class="empty-state">
	<?php if ( '' !== $mirayas_args['icon'] ) : ?>
		<div class="empty-state__icon">
			<?php mirayas_the_icon( $mirayas_args['icon'], 32 ); ?>
		</div>
	<?php endif; ?>

	<?php if ( '' !== $mirayas_args['eyebrow'] ) : ?>
		<p class="empty-state__eyebrow"><?php echo esc_html( $mirayas_args['eyebrow'] ); ?></p>
	<?php endif; ?>

	<?php if ( '' !== $mirayas_args['title'] ) : ?>
		<h2 class="empty-state__title"><?php echo wp_kses_post( $mirayas_args['title'] ); ?></h2>
	<?php endif; ?>

	<?php if ( '' !== $mirayas_args['text'] ) : ?>
		<p class="empty-state__text"><?php echo wp_kses_post( $mirayas_args['text'] ); ?></p>
	<?php endif; ?>

	<?php if ( $mirayas_args['search'] ) : ?>
		<div class="empty-state__search"><?php get_search_form(); ?></div>
	<?php endif; ?>

	<?php if ( ! empty( $mirayas_args['actions'] ) ) : ?>
		<div class="empty-state__actions">
			<?php foreach ( $mirayas_args['actions'] as $mirayas_action ) : ?>
				<?php if ( empty( $mirayas_action['url'] ) || empty( $mirayas_action['label'] ) ) { continue; } ?>
				<a
					class="button <?php echo empty( $mirayas_action['primary'] ) ? 'button--secondary' : 'button--primary'; ?>"
					href="<?php echo esc_url( $mirayas_action['url'] ); ?>"
				>
					<?php echo esc_html( $mirayas_action['label'] ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>