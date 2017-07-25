<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists('StoreMsav') ) {

	/**
	 * Base theme Class StoreMsav
	 *
	 * @author      Andrey Mishchenko
	 * @since       2.2.4.1
	 * @package     storemsav
	 */
	class StoreMsav {
		/**
		 * Current class instance
		 *
		 * @var StoreMsav
		 */
		private static $INSTANCE = null;


		/**
		 * Return current class instance
		 *
		 * @return StoreMsav
		 */
		public function get_instance() {
			if ( self::$INSTANCE == null ) {
				self::$INSTANCE = new StoreMsav();
			}

			return self::$INSTANCE;
		} // get_instance

	}

}