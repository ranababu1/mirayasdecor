<?php
/**
 * Site branding: custom logo or typeset wordmark.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="site-branding">
	<?php if ( has_custom_logo() ) : ?>
		<?php the_custom_logo(); ?>
	<?php else : ?>
		<a class="site-branding__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="site-branding__name"><?php bloginfo( 'name' ); ?></span>
			<?php $mirayas_description = get_bloginfo( 'description', 'display' ); ?>
			<?php if ( $mirayas_description ) : ?>
				<span class="site-branding__tagline"><?php echo esc_html( $mirayas_description ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>
</div>