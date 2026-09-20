<?php
/**
 * Generic content card, the loop fallback for custom post types rendered in
 * the post grid. Delegates to the shared post-card component so every grid
 * tile looks the same.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

get_template_part( 'template-parts/components/post-card' );