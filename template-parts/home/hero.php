<?php
/**
 * Front section: hero. Typographic, full-bleed, with a single call to action.
 *
 * The title and text elements are selective-refresh partial targets in the
 * Customizer, so their markup must stay stable.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_eyebrow = get_theme_mod( 'mirayas_hero_eyebrow', mirayas_default( 'hero_eyebrow' ) );
$mirayas_title   = get_theme_mod( 'mirayas_hero_title', mirayas_default( 'hero_title' ) );
$mirayas_text    = get_theme_mod( 'mirayas_hero_text', mirayas_default( 'hero_text' ) );
$mirayas_label   = get_theme_mod( 'mirayas_hero_button_text', mirayas_default( 'hero_button_text' ) );
$mirayas_url     = mirayas_has_woocommerce() ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>
<section class="hero front-section">
	<div class="container hero__inner">

		<?php if ( '' !== trim( (string) $mirayas_eyebrow ) ) : ?>
			<p class="hero__eyebrow"><?php echo esc_html( $mirayas_eyebrow ); ?></p>
		<?php endif; ?>

		<h1 class="hero__title"><?php echo esc_html( $mirayas_title ); ?></h1>

		<?php if ( '' !== trim( (string) $mirayas_text ) ) : ?>
			<p class="hero__text"><?php echo esc_html( $mirayas_text ); ?></p>
		<?php endif; ?>

		<?php if ( '' !== trim( (string) $mirayas_label ) ) : ?>
			<div class="hero__actions">
				<a class="button button--primary button--large" href="<?php echo esc_url( $mirayas_url ); ?>">
					<span><?php echo esc_html( $mirayas_label ); ?></span>
					<?php mirayas_the_icon( 'arrow-right' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>