<?php
/**
 * Storefront WooCommerce hooks
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header
 *
 * @see  storefront_product_search()
 * @see  storefront_header_cart()
 */
add_action( 'storemsav_header',             'storefront_product_search',            40 );
add_action( 'storemsav_header',             'storefront_header_cart',               60 );

