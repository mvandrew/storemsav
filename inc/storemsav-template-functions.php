<?php
/**
 * Store MSAV theme functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( !function_exists('storemsav_before_site') ) {
	/**
	 * Before Site Hook
	 *
	 * @return void
	 */
	function storemsav_before_site() {

		StoreMsavCounters::get_instance()->yandex_metrika_code();
		StoreMsavCounters::get_instance()->google_analytics_code();
		StoreMsavCounters::get_instance()->mailru_counter_code();

		// storemsav_before_site
	}
}