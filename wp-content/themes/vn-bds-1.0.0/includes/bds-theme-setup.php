<?php
/**
 * Theme only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/includes/back-compat.php';
}

if ( ! function_exists( 'vn_bds_theme_setup' ) ) :
/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Theme 1.0
 */
function vn_bds_theme_setup() {
	/*
	 * Make Theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Theme, use a find and
	 * replace to change 'bds' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'bds', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'bds-full-width', 1366, 480, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'bds' ),
		'footer' => __( 'Footer menu', 'bds' ),
	) );
}
endif; // bds_setup
add_action( 'after_setup_theme', 'vn_bds_theme_setup' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Theme 1.0
 */
function bds_scripts() {    
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
    wp_register_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );
    wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/assets/css/prettyPhoto.css' );
    wp_register_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css',
        array( 'bootstrap', 'font-awesome', 'animate', 'prettyPhoto', 'responsive' )
    );
}
add_action( 'wp_enqueue_scripts', 'bds_scripts' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Theme 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function bds_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bds' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'bds_wp_title', 10, 2 );

/**
 * Remove Help & Options tab in admin 
 */ 
add_filter( 'contextual_help', 'bds_remove_help_tabs', 999, 3 );
function bds_remove_help_tabs( $old_help, $screen_id, $screen ){
    $screen->remove_help_tabs();
    return $old_help;
}

function remove_screen_options_tab() {        
    return false;
}   
add_filter('screen_options_show_screen', 'remove_screen_options_tab');



require get_template_directory() . '/includes/meta-box/meta-box.php';

require get_template_directory() . '/includes/bds-post-types.php';