<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists('StoreMsavCounters') ) :

	/**
	 * Managing counters Class StoreMsavCounters
	 *
	 * @author      Andrey Mishchenko
	 * @since       2.2.4.1
	 * @package     storemsav
	 */
	class StoreMsavCounters {

		/**
		 * Current Class Instance.
		 *
		 * @var StoreMsavCounters
		 */
		private static $INSTANCE = null;

		/**
		 * Yandex Metrika Setting Name
		 * @var string
		 */
		public static $YANDEX_METRIKA_NAME = 'storemsav_counter_yandex_metrika';

		/**
		 * Yandex Webmaster Setting Name
		 * @var string
		 */
		public static $YANDEX_WEBMASTER_NAME = 'storemsav_counter_yandex_webmaster';

		/**
		 * Google Analytics Setting Name
		 * @var string
		 */
		public static $GOOGLE_ANALYTICS_NAME = 'storemsav_counter_google_analytics';

		/**
		 * Google Webmaster Setting Name
		 * @var string
		 */
		public static $GOOGLE_WEBMASTER_NAME = 'storemsav_counter_google_webmaster';

		/**
		 * Facebook Pixel ID Setting Name
		 * @var string
		 */
		public static $FACEBOOK_PIXEL_NAME = 'storemsav_counter_facebook_pixel';

		/**
		 * Mail.Ru Counter ID Setting Name
		 * @var string
		 */
		public static $MAILRU_ID_NAME = 'storemsav_counter_mailru_id';

		/**
		 * Yandex Metrika Counter ID
		 * @var string
		 */
		public $yandex_metrika_id;

		/**
		 * Yandex Webmaster ID
		 * @var string
		 */
		public $yandex_webmaster_id;

		/**
		 * Google Analytics ID
		 * @var string
		 */
		public $google_analytics_id;

		/**
		 * Google Webmaster ID
		 * @var string
		 */
		public $google_webmaster_id;

		/**
		 * Facebook Pixel ID
		 * @var string
		 */
		public $facebook_pixel_id;

		/**
		 * Mail.Ru Counter ID
		 * @var string
		 */
		public $mailru_id;


		/**
		 * StoreMsavCounters constructor.
		 */
		public function __construct() {

			$this->yandex_metrika_id        = get_theme_mod( self::$YANDEX_METRIKA_NAME, '' );
			$this->yandex_webmaster_id      = get_theme_mod( self::$YANDEX_WEBMASTER_NAME, '' );

			$this->google_analytics_id      = get_theme_mod( self::$GOOGLE_ANALYTICS_NAME, '' );
			$this->google_webmaster_id      = get_theme_mod( self::$GOOGLE_WEBMASTER_NAME, '' );

			$this->facebook_pixel_id        = get_theme_mod( self::$FACEBOOK_PIXEL_NAME, '' );

			$this->mailru_id                = get_theme_mod( self::$MAILRU_ID_NAME, '' );

			// __construct
		}

		/**
		 * Create new Counters class and return it.
		 *
		 * @return StoreMsavCounters
		 */
		public static function get_instance() {

			if ( self::$INSTANCE == null ) {
				self::$INSTANCE = new StoreMsavCounters();
			}

			return self::$INSTANCE;

			// get_instance
		}


		/**
		 * Added counters settings.
		 *
		 * @param WP_Customize_Manager $wp_customize The Customizer object.
		 * @param string $panel Settings Panel ID
		 */
		public function customize_register( &$wp_customize, $panel ) {

			// Counters Section
			$section = 'storemsav_counters_settings';
			$wp_customize->add_section( $section, array(
				'priority'              => 4,
				'title'                 => __( 'Counters IDs', 'storemsav' ),
				'panel'                 => $panel
			));

			// Yandex Metrika ID
			$name = self::$YANDEX_METRIKA_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Yandex Metrika ID', 'storemsav'),
				'section'               => $section,
				'settings'              => $name
			));

			// Yandex Webmaster ID
			$name = self::$YANDEX_WEBMASTER_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Yandex Webmaster ID', 'storemsav'),
				'section'               => $section,
				'settings'              => $name
			));

			// Google Analytics ID
			$name = self::$GOOGLE_ANALYTICS_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Google Analytics ID', 'storemsav'),
				'section'               => $section,
				'settings'              => $name
			));

			// Google Webmaster ID
			$name = self::$GOOGLE_WEBMASTER_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Google Webmaster ID', 'storemsav'),
				'section'               => $section,
				'settings'              => $name
			));

			// Facebook Pixel ID
			$name = self::$FACEBOOK_PIXEL_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Facebook Pixel ID', 'storemsav'),
				'section'               => $section,
				'settings'              => $name
			));

			// Mail.Ru Counter ID
			$name = self::$MAILRU_ID_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Mail.Ru Counter ID', 'storemsav'),
				'section'               => $section,
				'settings'              => $name
			));

			// customize_register
		}

	}

endif;