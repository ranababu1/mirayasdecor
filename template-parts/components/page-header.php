<?php
/**
 * The page header: breadcrumbs, title and optional subtitle.
 *
 * @package Mirayas_Decor
 *
 * @var array $args {
 *     @type string $title    Page title. Required.
 *     @type string $subtitle Optional supporting line.
 *     @type string $align    'left' (default) or 'center'.
 *     @type bool   $compact  Omits breadcrumbs and tightens spacing for
 *                            cart / checkout / account pages.
 * }
 */

defined( 'ABSPATH' ) || exit;

$mirayas_args = wp_parse_args(
	$args ?? array(),
	array(
		'title'    => '',
		'subtitle' => '',
		'align'    => 'left',
		'compact'  => false,
	)
);

$mirayas_classes = 'page-header page-header--' . ( 'center' === $mirayas_args['align'] ? 'center' : 'left' );

if ( $mirayas_args['compact'] ) {
	$mirayas_classes .= ' page-header--compact';
}
?>
<header class="<?php echo esc_attr( $mirayas_classes ); ?>">
	<div class="container page-header__inner">
		<?php if ( ! $mirayas_args['compact'] ) : ?>
			<?php mirayas_breadcrumbs(); ?>
		<?php endif; ?>

		<?php if ( '' !== $mirayas_args['title'] ) : ?>
			<h1 class="page-header__title"><?php echo wp_kses_post( $mirayas_args['title'] ); ?></h1>
		<?php endif; ?>

		<?php if ( '' !== $mirayas_args['subtitle'] ) : ?>
			<p class="page-header__subtitle"><?php echo wp_kses_post( $mirayas_args['subtitle'] ); ?></p>
		<?php endif; ?>
	</div>
</header>