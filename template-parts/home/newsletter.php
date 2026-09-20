<?php
/**
 * Front section: the newsletter panel. The title and text elements are
 * selective-refresh partial targets, so their markup must stay stable.
 *
 * Newsletter services can take over the form entirely by hooking
 * mirayas_newsletter_form; the default markup is a plain email capture
 * enhanced by assets/js/main.js.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_title = get_theme_mod( 'mirayas_newsletter_title', mirayas_default( 'newsletter_title' ) );
$mirayas_text  = get_theme_mod( 'mirayas_newsletter_text', mirayas_default( 'newsletter_text' ) );
?>
<section class="front-section newsletter">
	<div class="container newsletter__inner">

		<h2 class="newsletter__title"><?php echo esc_html( $mirayas_title ); ?></h2>

		<?php if ( '' !== trim( (string) $mirayas_text ) ) : ?>
			<p class="newsletter__text"><?php echo esc_html( $mirayas_text ); ?></p>
		<?php endif; ?>

		<div class="newsletter__form">
			<?php if ( has_action( 'mirayas_newsletter_form' ) ) : ?>
				<?php do_action( 'mirayas_newsletter_form' ); ?>
			<?php else : ?>
				<form class="newsletter-form" data-mirayas-form="newsletter" novalidate>
					<label class="screen-reader-text" for="mirayas-newsletter-email">
						<?php esc_html_e( 'Email address', 'mirayas-decor' ); ?>
					</label>
					<input
						type="email"
						id="mirayas-newsletter-email"
						class="newsletter-form__input"
						name="email"
						required
						autocomplete="email"
						placeholder="<?php esc_attr_e( 'Your email address', 'mirayas-decor' ); ?>"
					/>
					<button type="submit" class="button button--primary newsletter-form__submit">
						<span><?php esc_html_e( 'Subscribe', 'mirayas-decor' ); ?></span>
						<?php mirayas_the_icon( 'arrow-right' ); ?>
					</button>
					<p
						class="newsletter-form__note"
						data-mirayas-note="<?php esc_attr_e( 'Thank you — please confirm the subscription from your inbox.', 'mirayas-decor' ); ?>"
						hidden
					>
					</p>
				</form>
			<?php endif; ?>
		</div>
	</div>
</section>