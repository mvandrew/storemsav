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
// Determining theme folders.
// ------------------------------------------
define( '_STM_PARENT_DIR',                  get_template_directory() );
define( '_STM_CHILD_DIR',                   get_stylesheet_directory() );

define( '_STM_INCLUDES_DIR',                _STM_CHILD_DIR . '/inc' );
define( '_STM_CLASSES_DIR',                 _STM_INCLUDES_DIR . '/classes' );

// Template Elements Folder
define( '_STM_TEMPLATE_ELEMENTS_DIR',       _STM_CHILD_DIR . '/template-elements' );


// ------------------------------------------
// Determining theme links.
// ------------------------------------------
define( '_STM_PARENT_URI',                  get_template_directory_uri() );
define( '_STM_CHILD_URI',                   get_stylesheet_directory_uri() );


// ------------------------------------------
// Include library files.
// ------------------------------------------
require_once ( _STM_INCLUDES_DIR . '/functions.php' );
require_once ( _STM_INCLUDES_DIR . '/customizer.php' );
require_once ( _STM_INCLUDES_DIR . '/template-functions.php' );
require_once ( _STM_INCLUDES_DIR . '/template-hooks.php' );


// ------------------------------------------
// Include classes.
// ------------------------------------------
require_once ( _STM_CLASSES_DIR . '/class-storemsav.php' );
require_once ( _STM_CLASSES_DIR . '/class-storemsavcounters.php' );