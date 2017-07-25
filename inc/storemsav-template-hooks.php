<?php
/**
 * Registers the processing of the Store MSAV theme hooks.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Header Hooks
 *
 * @see storemsav_before_site()
 */
add_action( 'storemsav_before_site',                'storemsav_before_site' );


/**
 * Footer
 *
 * @see storefront_footer_widgets()
 * @see storemsav_credit()
 */
add_action( 'storemsav_footer',                     'storefront_footer_widgets', 10 );
add_action( 'storemsav_footer',                     'storemsav_credit', 20 );