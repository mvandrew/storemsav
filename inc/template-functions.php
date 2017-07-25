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