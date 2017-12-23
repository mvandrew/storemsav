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
	 * @uses        remove_action()
	 * @since       2.2.4.1
	 *
	 * @return      void
	 */
	function storemsav_remove_parent_hooks() {


		/**
		 * Remove the right sidebar on the shop pages
		 *
		 * @see storefront_get_sidebar()
		 */
		if ( is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_shop() ) {
			remove_action( 'storefront_sidebar',        'storefront_get_sidebar',           10 );
		}


		/**
		 * Post hooks
		 *
		 * @see storefront_post_meta()
		 * @see storefront_post_thumbnail()
		 */
		remove_action( 'storefront_loop_post',              'storefront_post_meta',             20 );
		remove_action( 'storefront_single_post',            'storefront_post_meta',             20 );
		remove_action( 'storefront_post_content_before',    'storefront_post_thumbnail',        10 );


		/**
		 * Homepage
		 *
		 * @see storefront_homepage_content()
		 * @see storefront_product_categories()
		 */
		remove_action( 'homepage',                          'storefront_homepage_content',      10 );
		remove_action( 'homepage',                          'storefront_product_categories',    20 );
		remove_action( 'homepage',                          'storefront_on_sale_products',      60 );
		remove_action( 'homepage',                          'storefront_best_selling_products', 70 );

		// storemsav_remove_parent_hooks
	}
}



if ( !function_exists('storemsav_remove_shop_body_class') ) {
	/**
	 * Remove the right sidebar body class on the shop pages
	 *
	 * @since       2.2.4.1
	 * @param       $classes array
	 *
	 * @return      array
	 */
	function storemsav_remove_shop_body_class( $classes ) {

		if ( is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_shop() ) {
			$classes = array_unique($classes);
			unset( $classes[array_search('right-sidebar', $classes)] );
			$classes[] = 'page-template-template-fullwidth-php';
		}

		return $classes;
		// storemsav_remove_shop_body_class
	}
}