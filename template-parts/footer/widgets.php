<?php
/**
 * Footer widget columns: footer-1 through footer-3.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

$mirayas_active = 0;

for ( $mirayas_i = 1; $mirayas_i <= 3; $mirayas_i++ ) {
	if ( is_active_sidebar( 'footer-' . $mirayas_i ) ) {
		$mirayas_active++;
	}
}

if ( ! $mirayas_active ) {
	return;
}
?>
<div class="site-footer__widgets">
	<div class="container site-footer__widgets-inner">
		<?php for ( $mirayas_i = 1; $mirayas_i <= 3; $mirayas_i++ ) : ?>
			<?php if ( is_active_sidebar( 'footer-' . $mirayas_i ) ) : ?>
				<div class="site-footer__col site-footer__col--<?php echo esc_attr( $mirayas_i ); ?>">
					<?php dynamic_sidebar( 'footer-' . $mirayas_i ); ?>
				</div>
			<?php endif; ?>
		<?php endfor; ?>
	</div>
</div>