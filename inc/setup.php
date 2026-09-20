<?php
/**
 * Theme setup: supports, menus, image sizes and widget areas.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Configure theme features.
 */
function mirayas_setup() {
	load_theme_textdomain( 'mirayas-decor', MIRAYAS_DIR . 'languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 360,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Declared unconditionally so shop support is ready the moment the
	 * WooCommerce plugin is activated. The grid defaults match the front end.
	 */
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 480,
			'single_image_width'    => 1000,
			'product_grid'          => array(
				'default_columns' => 3,
				'min_columns'     => 2,
				'max_columns'     => 4,
			),
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'mirayas-decor' ),
			'footer'  => __( 'Footer Menu', 'mirayas-decor' ),
		)
	);

	add_image_size( 'mirayas-card', 640, 800, true );
	add_image_size( 'mirayas-wide', 1200, 900, true );

	/*
	 * Editor colours mirror the front-end design tokens (see assets/css/tokens.css)
	 * so content created in the block editor matches the storefront.
	 */
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Ink', 'mirayas-decor' ),
				'slug'  => 'ink',
				'color' => '#1d1d1b',
			),
			array(
				'name'  => __( 'Forest', 'mirayas-decor' ),
				'slug'  => 'forest',
				'color' => '#303a32',
			),
			array(
				'name'  => __( 'Clay', 'mirayas-decor' ),
				'slug'  => 'clay',
				'color' => '#9a7b5a',
			),
			array(
				'name'  => __( 'Sand', 'mirayas-decor' ),
				'slug'  => 'sand',
				'color' => '#f4f1eb',
			),
			array(
				'name'  => __( 'Ivory', 'mirayas-decor' ),
				'slug'  => 'ivory',
				'color' => '#faf9f6',
			),
		)
	);

	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => __( 'Small', 'mirayas-decor' ),
				'shortName' => __( 'S', 'mirayas-decor' ),
				'slug'      => 'small',
				'size'      => 14,
			),
			array(
				'name'      => __( 'Normal', 'mirayas-decor' ),
				'shortName' => __( 'M', 'mirayas-decor' ),
				'slug'      => 'normal',
				'size'      => 16,
			),
			array(
				'name'      => __( 'Medium', 'mirayas-decor' ),
				'shortName' => __( 'L', 'mirayas-decor' ),
				'slug'      => 'medium',
				'size'      => 20,
			),
			array(
				'name'      => __( 'Large', 'mirayas-decor' ),
				'shortName' => __( 'XL', 'mirayas-decor' ),
				'slug'      => 'large',
				'size'      => 28,
			),
			array(
				'name'      => __( 'Display', 'mirayas-decor' ),
				'shortName' => __( 'XXL', 'mirayas-decor' ),
				'slug'      => 'xlarge',
				'size'      => 42,
			),
		)
	);

	// Load the design tokens and fonts into the block editor.
	add_editor_style( array( 'assets/css/fonts.css', 'assets/css/tokens.css' ) );
}
add_action( 'after_setup_theme', 'mirayas_setup' );

/**
 * Set the content width global.
 */
function mirayas_set_content_width() {
	$GLOBALS['content_width'] = (int) apply_filters( 'mirayas_content_width', 1240 );
}
add_action( 'after_setup_theme', 'mirayas_set_content_width', 0 );

/**
 * Register footer widget areas.
 */
function mirayas_widgets_init() {
	$mirayas_common = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	for ( $mirayas_i = 1; $mirayas_i <= 3; $mirayas_i++ ) {
		register_sidebar(
			array_merge(
				$mirayas_common,
				array(
					'name'        => sprintf(
						/* translators: %d: footer column number. */
						__( 'Footer Column %d', 'mirayas-decor' ),
						$mirayas_i
					),
					'id'          => 'footer-' . $mirayas_i,
					'description' => __( 'Displayed as a column in the footer.', 'mirayas-decor' ),
				)
			)
		);
	}
}
add_action( 'widgets_init', 'mirayas_widgets_init' );