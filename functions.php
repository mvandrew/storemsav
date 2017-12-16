<?php
/**
 * Store MSAV function files initialize.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// ------------------------------------------
// Determining the Store MSAV theme version.
// ------------------------------------------
$storemsav_theme                            = wp_get_theme( 'storemsav' );
define( '_STM_VERSION',                     $storemsav_theme['Version'] );


// ------------------------------------------
// Determining theme folders.
// ------------------------------------------
define( '_STM_PARENT_DIR',                  get_template_directory() );
define( '_STM_CHILD_DIR',                   get_stylesheet_directory() );

define( '_STM_INCLUDES_DIR',                _STM_CHILD_DIR . '/inc' );
define( '_STM_CLASSES_DIR',                 _STM_INCLUDES_DIR . '/classes' );
define( '_STM_WOOCOMMERCE_DIR',             _STM_INCLUDES_DIR . '/woocommerce' );

// Template Elements Folder
define( '_STM_TEMPLATE_ELEMENTS_DIR',       _STM_CHILD_DIR . '/template-elements' );


// ------------------------------------------
// Determining theme links.
// ------------------------------------------
define( '_STM_PARENT_URI',                  get_template_directory_uri() );
define( '_STM_CHILD_URI',                   get_stylesheet_directory_uri() );
define( '_STM_STYLESHEETS',                 _STM_CHILD_URI . '/stylesheets' );
define( '_STM_JAVASCRIPTS',                 _STM_CHILD_URI . '/javascripts' );


// ------------------------------------------
// Include library files.
// ------------------------------------------
require_once ( _STM_INCLUDES_DIR . '/functions.php' );
require_once ( _STM_INCLUDES_DIR . '/customizer.php' );
require_once ( _STM_INCLUDES_DIR . '/template-functions.php' );
require_once ( _STM_INCLUDES_DIR . '/template-hooks.php' );
require_once ( _STM_INCLUDES_DIR . '/storemsav-template-functions.php' );
require_once ( _STM_INCLUDES_DIR . '/storemsav-template-hooks.php' );


// ------------------------------------------
// Include WooCommerce Hooks
// ------------------------------------------
if ( storemsav_is_woocommerce_activated() ) {
	require_once ( _STM_WOOCOMMERCE_DIR . '/storemsav-woocommerce-template-functions.php' );
	require_once ( _STM_WOOCOMMERCE_DIR . '/storemsav-woocommerce-template-hooks.php' );
}


// ------------------------------------------
// Include classes.
// ------------------------------------------
require_once ( _STM_CLASSES_DIR . '/class-storemsav.php' );
require_once ( _STM_CLASSES_DIR . '/class-storemsavcounters.php' );
