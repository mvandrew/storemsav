<?php
/**
 * WordPress core functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'storemsav_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 *
	 * @return bool
	 */
	function storemsav_is_woocommerce_activated() {

		return class_exists( 'WooCommerce' ) ? true : false;

		// storemsav_is_woocommerce_activated
	}
}


if ( !function_exists('storemsav_enqueue_scripts') ) {
	/**
	 * Enqueue Scripts Hook function
	 *
	 * @return void
	 */
	function storemsav_enqueue_scripts() {

		/**
		 * Styles
		 */
		wp_enqueue_style(
			'storemsav-style',
			_STM_STYLESHEETS . '/style.css',
			array('storefront-style'),
			_STM_VERSION
		);


		/**
		 * Fonts
		 */
		wp_dequeue_style( 'storefront-fonts' ); // Remove parent theme font without cyrillic code page support

		$google_fonts = apply_filters(
			'storemsav_google_font_families',
			array(
				'source-sans-pro' => 'Source+Sans+Pro:300,300i,400,400i,600,700,900',
				)
		);

		$query_args = array(
			'family' => implode( '|', $google_fonts ),
			'subset' => urlencode( 'cyrillic,cyrillic-ext,latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		wp_enqueue_style( 'storemsav-fonts', $fonts_url, array(), null );

		// storemsav_enqueue_scripts
	}
}


if ( !function_exists( 'storemsav_setup') ) {
	/**
	 * After Setup Theme Hook
	 *
	 * @return void
	 */
	function storemsav_setup () {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'storemsav', _STM_CHILD_DIR . '/languages' );

		// storemsav_setup
	}
}


if ( !function_exists('storemsav_checkbox_sanitize') ) {
	/**
	 * Checkbox sanitization
	 *
	 * @param $input
	 *
	 * @see storemsav_customize_register()
	 *
	 * @return int|string
	 */
	function storemsav_checkbox_sanitize( $input ) {

		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}

		// storemsav_checkbox_sanitize
	}
}