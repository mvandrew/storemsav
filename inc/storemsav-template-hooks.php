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