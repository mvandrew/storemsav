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
 * @see storemsav_setup()
 * @see storemsav_customize_register()
 */
add_action( 'wp_enqueue_scripts',               'storemsav_enqueue_scripts',        40);
add_action( 'after_setup_theme',                'storemsav_setup' );
add_action( 'customize_register',               'storemsav_customize_register' );


/**
 * Header Hooks
 *
 * @see storemsav_head()
 */
add_action( 'wp_head',                          'storemsav_head' );