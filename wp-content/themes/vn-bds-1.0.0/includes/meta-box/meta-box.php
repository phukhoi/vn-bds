<?php
/*
Plugin Name: Meta Box
Plugin URI: http://metabox.io
Description: Create meta box for editing pages in WordPress. Compatible with custom post types since WP 3.0
Version: 4.4.2
Author: Rilwis
Author URI: http://www.deluxeblogtips.com
License: GPL2+
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Script version, used to add version for scripts and styles
define( 'RWMB_VER', '4.4.2' );

// Define plugin URLs, for fast enqueuing scripts and styles
if ( ! defined( 'RWMB_URL' ) )
	define( 'RWMB_URL', trailingslashit(get_template_directory_uri() . '/includes/' . basename(dirname(__FILE__ )))  );
    
define( 'RWMB_JS_URL', trailingslashit( RWMB_URL . 'js' ) );
define( 'RWMB_CSS_URL', trailingslashit( RWMB_URL . 'css' ) );

// Plugin paths, for including files
if ( ! defined( 'RWMB_DIR' ) )
	define( 'RWMB_DIR', trailingslashit(get_template_directory() . '/includes/' . basename(dirname(__FILE__ ) )) );
define( 'RWMB_INC_DIR', trailingslashit( RWMB_DIR . 'inc' ) );
define( 'RWMB_FIELDS_DIR', trailingslashit( RWMB_INC_DIR . 'fields' ) );

// Optimize code for loading plugin files ONLY on admin side
// @see http://www.deluxeblogtips.com/?p=345

// Helper function to retrieve meta value
require_once RWMB_INC_DIR . 'helpers.php';

if ( is_admin() )
{
	require_once RWMB_INC_DIR . 'common.php';
	require_once RWMB_INC_DIR . 'field.php';

	// Field classes
	foreach ( glob( RWMB_FIELDS_DIR . '*.php' ) as $file )
	{
		require_once $file;
	}

	// Main file
	require_once RWMB_INC_DIR . 'meta-box.php';
	require_once RWMB_INC_DIR . 'init.php';
}
