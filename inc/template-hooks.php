<?php
/**
 * Registers the processing of the theme and WordPress core hooks.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Template System Hooks
 *
 * @see storemsav_enqueue_scripts()
 */
add_action( 'wp_enqueue_scripts',               'storemsav_enqueue_scripts',        40);
add_action( 'after_setup_theme',                'storemsav_setup' );