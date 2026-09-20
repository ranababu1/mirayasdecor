<?php
/**
 * The comments template.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered it, stop here.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-area__title">
			<?php
			printf(
				/* translators: %s: comment count. */
				esc_html( _n( '%s Comment', '%s Comments', get_comments_number(), 'mirayas-decor' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>

		<ol class="comments-area__list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				)
			);
			?>
		</ol>

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			the_comments_pagination(
				array(
					'prev_text' => mirayas_get_icon( 'arrow-left' ),
					'next_text' => mirayas_get_icon( 'arrow-right' ),
				)
			);
		endif;
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="comments-area__closed note">
				<?php esc_html_e( 'Comments are closed.', 'mirayas-decor' ); ?>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_form'          => 'comments-area__form',
			'title_reply_before'  => '<h2 class="comments-area__title">',
			'title_reply_after'   => '</h2>',
			'title_reply'         => __( 'Leave a comment', 'mirayas-decor' ),
			'title_reply_to'      => __( 'Reply to %s', 'mirayas-decor' ),
			'label_submit'        => __( 'Post comment', 'mirayas-decor' ),
			'class_submit'        => 'button button--primary',
		)
	);
	?>

</div><!-- #comments -->