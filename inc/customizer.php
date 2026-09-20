<?php
/**
 * Customizer settings: announcement bar, front page copy and the footer.
 *
 * Defaults come from mirayas_default() (see inc/template-functions.php), so
 * templates never hardcode copy. Text settings use postMessage transport
 * with selective-refresh partials where the markup contract is stable.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Customizer sections, settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function mirayas_customize_register( $wp_customize ) {
	// Live-preview the core identity settings.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->add_panel(
		'mirayas',
		array(
			'title'    => __( 'Mirayas Decor', 'mirayas-decor' ),
			'priority' => 10,
		)
	);

	/* Header: the announcement bar. */
	$wp_customize->add_section(
		'mirayas_header',
		array(
			'title' => __( 'Header', 'mirayas-decor' ),
			'panel' => 'mirayas',
		)
	);

	$wp_customize->add_setting(
		'mirayas_announcement_show',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		'mirayas_announcement_show',
		array(
			'label'   => __( 'Show the announcement bar', 'mirayas-decor' ),
			'section' => 'mirayas_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'mirayas_announcement_text',
		array(
			'default'           => mirayas_default( 'announcement_text' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'mirayas_announcement_text',
		array(
			'label'   => __( 'Announcement text', 'mirayas-decor' ),
			'section' => 'mirayas_header',
			'type'    => 'text',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'mirayas_announcement_text',
		array(
			'selector'        => '.announcement-bar__text',
			'render_callback' => function () {
				return sprintf(
					'<p class="announcement-bar__text">%s</p>',
					esc_html( get_theme_mod( 'mirayas_announcement_text', mirayas_default( 'announcement_text' ) ) )
				);
			},
		)
	);

	/* Front page: section toggles and copy. */
	$wp_customize->add_section(
		'mirayas_front',
		array(
			'title' => __( 'Front Page', 'mirayas-decor' ),
			'panel' => 'mirayas',
		)
	);

	$mirayas_sections = array(
		'hero'        => __( 'Hero', 'mirayas-decor' ),
		'featured'    => __( 'Featured products', 'mirayas-decor' ),
		'collections' => __( 'Collections', 'mirayas-decor' ),
		'story'       => __( 'Brand story', 'mirayas-decor' ),
		'editorial'   => __( 'Journal', 'mirayas-decor' ),
		'trust'       => __( 'Trust strip', 'mirayas-decor' ),
		'newsletter'  => __( 'Newsletter', 'mirayas-decor' ),
	);

	foreach ( $mirayas_sections as $mirayas_slug => $mirayas_label ) {
		$wp_customize->add_setting(
			'mirayas_show_' . $mirayas_slug,
			array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_boolean',
			)
		);
		$wp_customize->add_control(
			'mirayas_show_' . $mirayas_slug,
			array(
				/* translators: %s: front page section name. */
				'label'   => sprintf( __( 'Show “%s”', 'mirayas-decor' ), $mirayas_label ),
				'section' => 'mirayas_front',
				'type'    => 'checkbox',
			)
		);
	}

	$mirayas_fields = array(
		'hero_eyebrow'      => array( __( 'Hero eyebrow', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'hero_title'        => array( __( 'Hero title', 'mirayas-decor' ), 'sanitize_text_field', 'text', true ),
		'hero_text'         => array( __( 'Hero intro text', 'mirayas-decor' ), 'sanitize_textarea_field', 'textarea', true ),
		'hero_button_text'  => array( __( 'Hero button label', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'collections_title' => array( __( 'Collections heading', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'editorial_title'   => array( __( 'Journal heading', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'trust_item_1'      => array( __( 'Trust point 1', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'trust_item_2'      => array( __( 'Trust point 2', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'trust_item_3'      => array( __( 'Trust point 3', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'trust_item_4'      => array( __( 'Trust point 4', 'mirayas-decor' ), 'sanitize_text_field', 'text', false ),
		'newsletter_title'  => array( __( 'Newsletter heading', 'mirayas-decor' ), 'sanitize_text_field', 'text', true ),
		'newsletter_text'   => array( __( 'Newsletter text', 'mirayas-decor' ), 'sanitize_textarea_field', 'textarea', true ),
	);

	foreach ( $mirayas_fields as $mirayas_key => $mirayas_field ) {
		$wp_customize->add_setting(
			'mirayas_' . $mirayas_key,
			array(
				'default'           => mirayas_default( $mirayas_key ),
				'sanitize_callback' => $mirayas_field[1],
				'transport'         => $mirayas_field[3] ? 'postMessage' : 'refresh',
			)
		);
		$wp_customize->add_control(
			'mirayas_' . $mirayas_key,
			array(
				'label'   => $mirayas_field[0],
				'section' => 'mirayas_front',
				'type'    => $mirayas_field[2],
			)
		);
	}

	$wp_customize->selective_refresh->add_partial(
		'mirayas_hero_title',
		array(
			'selector'        => '.hero__title',
			'render_callback' => function () {
				return sprintf(
					'<h1 class="hero__title">%s</h1>',
					esc_html( get_theme_mod( 'mirayas_hero_title', mirayas_default( 'hero_title' ) ) )
				);
			},
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'mirayas_hero_text',
		array(
			'selector'        => '.hero__text',
			'render_callback' => function () {
				return sprintf(
					'<p class="hero__text">%s</p>',
					esc_html( get_theme_mod( 'mirayas_hero_text', mirayas_default( 'hero_text' ) ) )
				);
			},
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'mirayas_newsletter_title',
		array(
			'selector'        => '.newsletter__title',
			'render_callback' => function () {
				return sprintf(
					'<h2 class="newsletter__title">%s</h2>',
					esc_html( get_theme_mod( 'mirayas_newsletter_title', mirayas_default( 'newsletter_title' ) ) )
				);
			},
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'mirayas_newsletter_text',
		array(
			'selector'        => '.newsletter__text',
			'render_callback' => function () {
				return sprintf(
					'<p class="newsletter__text">%s</p>',
					esc_html( get_theme_mod( 'mirayas_newsletter_text', mirayas_default( 'newsletter_text' ) ) )
				);
			},
		)
	);

	/* Footer: copyright line. */
	$wp_customize->add_section(
		'mirayas_footer',
		array(
			'title' => __( 'Footer', 'mirayas-decor' ),
			'panel' => 'mirayas',
		)
	);

	$wp_customize->add_setting(
		'mirayas_footer_copyright',
		array(
			'default'           => mirayas_default( 'footer_copyright' ),
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'mirayas_footer_copyright',
		array(
			'label'       => __( 'Copyright line', 'mirayas-decor' ),
			'description' => __( 'Use %year% and %site% for the year and site name.', 'mirayas-decor' ),
			'section'     => 'mirayas_footer',
			'type'        => 'textarea',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'mirayas_footer_copyright',
		array(
			'selector'        => '.site-footer__copy',
			'render_callback' => function () {
				$mirayas_copy = get_theme_mod( 'mirayas_footer_copyright', mirayas_default( 'footer_copyright' ) );

				return sprintf(
					'<p class="site-footer__copy">%s</p>',
					wp_kses_post(
						str_replace(
							array( '%year%', '%site%' ),
							array( gmdate( 'Y' ), get_bloginfo( 'name' ) ),
							$mirayas_copy
						)
					)
				);
			},
		)
	);
}
add_action( 'customize_register', 'mirayas_customize_register' );