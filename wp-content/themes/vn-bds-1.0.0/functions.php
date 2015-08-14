<?php
$GLOBALS['theme_textdomain'] = 'bds';
$GLOBALS['theme_version'] = '1.0.0';

if ( !defined('TEMPLATE_URL') )
    define('TEMPLATE_URL', get_template_directory_uri() . '/assets' );

/**
 * Register three Theme widget areas.
 *
 * @since Theme 1.0
 */
function bds_widgets_init() {
	require get_template_directory() . '/includes/bds-widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'bds' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'bds' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'bds' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'bds' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'bds' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'bds' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bds_widgets_init' );

/**
 * Create custom user roles for this theme
 */ 
function bds_setup_user_roles() {
    add_role( 'saler', __('Saler', 'bds'), array(
        'read' => true,
        'manage_customer' => true, // quản lý khách hàng
    ) );
}
add_action( 'after_switch_theme', 'bds_setup_user_roles' );

require get_template_directory() . '/includes/bds-debug-functions.php';

require get_template_directory() . '/includes/bds-modified-wp-defaults.php';

// Custom template tags for this theme.
require get_template_directory() . '/includes/bds-template-tags.php';

require get_template_directory() . '/includes/bds-theme-setup.php';