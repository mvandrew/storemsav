<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @since       2.2.4.1
 * @package     storemsav
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storemsav_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storemsav_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storemsav_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
