<?php
/**
 * Front section: the trust strip — four short service promises.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_items = array(
	array(
		'icon' => 'truck',
		'text' => get_theme_mod( 'mirayas_trust_item_1', mirayas_default( 'trust_item_1' ) ),
	),
	array(
		'icon' => 'shield',
		'text' => get_theme_mod( 'mirayas_trust_item_2', mirayas_default( 'trust_item_2' ) ),
	),
	array(
		'icon' => 'refresh',
		'text' => get_theme_mod( 'mirayas_trust_item_3', mirayas_default( 'trust_item_3' ) ),
	),
	array(
		'icon' => 'leaf',
		'text' => get_theme_mod( 'mirayas_trust_item_4', mirayas_default( 'trust_item_4' ) ),
	),
);

$mirayas_items = apply_filters( 'mirayas_trust_items', $mirayas_items );
?>
<section class="front-section trust">
	<div class="container">
		<ul class="trust__list">
			<?php foreach ( $mirayas_items as $mirayas_item ) : ?>
				<?php if ( empty( $mirayas_item['text'] ) || '' === trim( (string) $mirayas_item['text'] ) ) { continue; } ?>
				<li class="trust__item">
					<span class="trust__icon" aria-hidden="true">
						<?php mirayas_the_icon( $mirayas_item['icon'] ); ?>
					</span>
					<span class="trust__text"><?php echo esc_html( $mirayas_item['text'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>