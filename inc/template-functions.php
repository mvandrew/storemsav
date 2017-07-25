<?php
/**
 * WordPress theme functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( !function_exists('storemsav_head') ) {
	/**
	 * Displays additional info in the HEAD tag
	 *
	 * @return void
	 */
	function storemsav_head() {

		// Output counters code
		StoreMsavCounters::get_instance()->yandex_webmaster_code();
		StoreMsavCounters::get_instance()->google_webmaster_code();
		StoreMsavCounters::get_instance()->facebook_pixel_code();

		// storemsav_head
	}
}


if ( !function_exists('storemsav_remove_parent_hooks') ) {
	/**
	 * Remove parent hooks
	 *
	 * @return      void
	 *
	 * @since       2.2.4.1
	 */
	function storemsav_remove_parent_hooks() {

		/**
		 * Post hooks
		 */
		remove_action( 'storefront_loop_post',           'storefront_post_meta',            20 );
		remove_action( 'storefront_single_post',         'storefront_post_meta',            20 );

		// storemsav_remove_parent_hooks
	}
}