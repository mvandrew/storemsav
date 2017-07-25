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
		 * Hide post author
		 *
		 * @var bool
		 */
		public $hide_post_author;

		/**
		 * Hide post date
		 *
		 * @var bool
		 */
		public $hide_post_date;

		/**
		 * Hide powered link
		 *
		 * @var bool
		 */
		public $hide_powered_link;

		/**
		 * Show design site link
		 *
		 * @var bool
		 */
		public $show_design_site_link;

		/**
		 * Design site link text
		 *
		 * @var string
		 */
		public $design_site_label;

		/**
		 * Design site link URL
		 *
		 * @var string
		 */
		public $design_site_url;

		/**
		 * Design site link alias
		 *
		 * @var string
		 */
		public $design_site_alias;

		/**
		 * Show Copyright Info
		 *
		 * @var bool
		 */
		public $show_copyright;

		/**
		 * Copyright Owner
		 *
		 * @var string
		 */
		public $copyright_owner;

		/**
		 * First Copyright Year
		 *
		 * @var int
		 */
		public $copyright_year;


		/**
		 * StoreMsav constructor.
		 */
		public function __construct() {

			// Display Settings
			$this->hide_post_author         = get_theme_mod( 'storemsav_hide_post_author', 0 ) == 1 ? true : false;
			$this->hide_post_date           = get_theme_mod( 'storemsav_hide_post_date', 0 ) == 1 ? true : false;
			$this->hide_powered_link        = get_theme_mod( 'storemsav_hide_powered_link', 0 ) == 1 ? true : false;

			// Designed Site Link
			$this->show_design_site_link    = get_theme_mod( 'storemsav_show_design_site_link', 0 ) == 1 ? true : false;
			$this->design_site_label        = get_theme_mod( 'storemsav_design_site_label', '' );
			$this->design_site_url          = get_theme_mod( 'storemsav_design_site_url', '' );
			$this->design_site_alias        = get_theme_mod( 'storemsav_design_site_alias', '' );

			// Copyright Info
			$this->show_copyright           = get_theme_mod( 'storemsav_show_copyright', 0 ) == 1 ? true : false;
			$this->copyright_owner          = get_theme_mod( 'storemsav_copyright_owner', get_bloginfo( 'name' ) );
			if ( $this->copyright_owner == '' ) {
				$this->copyright_owner      = get_bloginfo( 'name' );
			}
			$this->copyright_year           = get_theme_mod( 'storemsav_copyright_year', 0 );
			if ( $this->copyright_year == '' || $this->copyright_year == 0 ) {
				$date                       = new DateTime();
				$this->copyright_year       = $date->format('Y');
			}

			// __construct
		}


		/**
		 * Return current class instance
		 *
		 * @return StoreMsav
		 */
		public static function get_instance() {

			if ( self::$INSTANCE == null ) {
				self::$INSTANCE = new StoreMsav();
			}

			return self::$INSTANCE;

			// get_instance
		}

	}

}