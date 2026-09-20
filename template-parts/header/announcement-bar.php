<?php
/**
 * Announcement bar: a single line of store news above the masthead.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

if ( ! (bool) get_theme_mod( 'mirayas_announcement_show', true ) ) {
	return;
}

$mirayas_text = get_theme_mod( 'mirayas_announcement_text', mirayas_default( 'announcement_text' ) );

if ( '' === trim( (string) $mirayas_text ) ) {
	return;
}
?>
<div class="announcement-bar">
	<div class="container announcement-bar__inner">
		<p class="announcement-bar__text"><?php echo esc_html( $mirayas_text ); ?></p>
	</div>
</div>