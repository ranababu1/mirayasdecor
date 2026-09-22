<?php
/**
 * The theme footer.
 *
 * @package Mirayas_Decor
 */

defined( 'ABSPATH' ) || exit;
?>

<footer id="colophon" class="site-footer">

	<?php get_template_part( 'template-parts/footer/widgets' ); ?>

	<div class="site-footer__bottom">
		<div class="container site-footer__bottom-inner">
			<p class="site-footer__copy">
				<?php
				echo mirayas_get_footer_copyright();
				?>
			</p>

			<?php get_template_part( 'template-parts/components/payment-icons' ); ?>
		</div>
	</div>

</footer><!-- #colophon -->

</div><!-- #page -->

<?php
wp_footer();
?>

</body>
</html>