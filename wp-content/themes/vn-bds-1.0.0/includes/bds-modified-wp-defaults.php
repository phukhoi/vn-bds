<?php
if ( !defined('ABSPATH' ) ) die();

return new BDS_Modified_WP_Default();
/**
 * BDS_Modified_WP_Default
 * 
 * @subpackage BDS
 * @since 1.0
 * @author Thinh Pham
 */
class BDS_Modified_WP_Default {
    
    /**
     * String theme version
     */ 
    public $version;
    
    /**
     * String theme text domain
     */ 
    public $tdm;
    
    /**
     * BDS_Modified_WP_Default::__construct()
     * 
     * @return
     */
    function __construct() {
        
        $this->version = $GLOBALS['theme_version'];
        
        $this->tdm = $GLOBALS['theme_textdomain'];
        
        /* Customize Login page  */ 
        add_filter( 'login_headerurl' , array( $this, 'login_headerurl' ) );
        
        add_filter( 'login_headertitle' , array( $this , 'login_headertitle' ) );
        
        add_action( 'login_head' , array( $this , 'login_head' ) );
        
        add_action( 'login_footer' , array( $this , 'login_footer' ) );
            
        /* Admin page title **/
        add_filter( 'admin_title', array( $this, 'admin_title' ) );
        
        /* Admin footer text */
        add_filter( 'admin_footer_text' , array( $this , 'admin_footer_text' ) );
        
        /* Favico in admin & login page */   
        add_action('login_head', array($this, 'add_favicon'));
        
        add_action('admin_head', array($this, 'add_favicon'));        
        
        /* Setup admin menu */
        add_action( 'admin_menu', array($this, 'remove_menus'), 102 );
		
        /* Setup admin bar menu */
		add_action( 'admin_bar_menu', array($this, 'remove_admin_bar_nodes'), 999 );
            
        /* Clean up widget settings that weren't set at installation */
        add_action( 'after_setup_theme', array($this, 'set_missing_widget_options') );
        
        if ( !current_user_can('manage_options') )  :
        
        	add_action( 'wp_loaded' , array( $this , 'notice_dismiss' ) , 2 );
    		
    		add_action( 'admin_menu', array($this, 'wps_hide_update_notice') );
            
        endif;
    }
    
    /**
     * BDS_Modified_WP_Default::set_missing_widget_options()
     * 
     * @return void
     */
    function set_missing_widget_options( ){
        add_option( 'widget_pages', array ( '_multiwidget' => 1 ) );
        add_option( 'widget_calendar', array ( '_multiwidget' => 1 ) );
        add_option( 'widget_tag_cloud', array ( '_multiwidget' => 1 ) );
        add_option( 'widget_nav_menu', array ( '_multiwidget' => 1 ) );
    }
	
	/**
	 * BDS_Modified_WP_Default::wps_hide_update_notice()
	 * 
	 * @return
	 */
	function wps_hide_update_notice() { 
		remove_action( 'admin_notices', 'update_nag', 3 );
	}
    
    /**
     * BDS_Modified_WP_Default::add_favicon()
     * Change default WP Favico Icon
     * @return
     */
    function add_favicon() {
        
      	$favicon_url = get_stylesheet_directory_uri() . '/images/icons/favicon.ico';
        
    	printf('<link rel="shortcut icon" href="%s/images/favicon.png" />', TEMPLATE_URL);
    }

    
    /**
     * BDS_Modified_WP_Default::login_headerurl()
     * 
     * @return
     */
    function login_headerurl() {
    	$url = strip_tags( get_bloginfo('url') );
    	return $url;
    }
    
	/**
	 * BDS_Modified_WP_Default::login_headertitle()
	 * 
	 * @return
	 */
	function login_headertitle() {
        $title = strip_tags( get_bloginfo('name') );
		return $title;
	}

	// FilterStart
	/**
	 * BDS_Modified_WP_Default::login_head()
	 * 
	 * @return
	 */
	function login_head() {
		echo '<style type="text/css">.login h1 a { background-image: url(' . TEMPLATE_URL . '/images/logo.png); }</style>';        
        wp_enqueue_style( 'login.css', TEMPLATE_URL . '/css/login.css' );
	}
    
	/**
	 * BDS_Modified_WP_Default::login_footer()
	 * 
	 * @return
	 */
	function login_footer() {
	   /**
        * @TODO 
        */ 
        return ;
	}
    /**
     * BDS_Modified_WP_Default::notice_dismiss()
     * 
     * @return
     */
    function notice_dismiss () {
        
        add_filter( 'auto_update_core' , array( $this , 'notice_update_core' ) );
        
        add_filter( 'auto_update_plugin' , array( $this , 'notice_update_plugin' ) );
        
        add_filter( 'auto_update_theme' , array( $this , 'notice_update_theme' ) );
    }
	
	/**
	 * BDS_Modified_WP_Default::remove_admin_bar_nodes()
	 * 
	 * @param mixed $wp_admin_bar
	 * @return
	 */
	function remove_admin_bar_nodes( $wp_admin_bar ) {
	   //$wp_admin_bar->remove_node( 'site-name' );
	   $wp_admin_bar->remove_node( 'wp-logo' );
       $wp_admin_bar->remove_node( 'comments' );
	   //$wp_admin_bar->remove_node( 'new-post' );
	   //$wp_admin_bar->remove_node( 'new-page' );
	}
    
    /**
     * BDS_Modified_WP_Default::remove_menus()
     * 
     * @return
     */
    function remove_menus() {
        remove_menu_page( 'edit-comments.php' );
        //remove_menu_page( 'edit.php?post_type=page' );
        remove_menu_page( 'tools.php' );
        
        /* remove update footer */
        add_filter( 'update_footer' , array( $this, 'footer_version') , 20) ;
    }
    
    /**
     * BDS_Modified_WP_Default::footer_version()
     * 
     * @param string $text
     * @return
     */
    function footer_version( $text ) {
        return sprintf( "%s %s", __('Version', $this->tdm ), $this->version );
    }
    
	/**
	 * BDS_Modified_WP_Default::notice_update_core()
	 * 
	 * @param mixed $site_transient_update_core
	 * @return
	 */
	function notice_update_core( $site_transient_update_core ) {
		$site_transient_update_core->updates[0]->response = 'latest';
		
		return $site_transient_update_core;
	}
    
	/**
	 * BDS_Modified_WP_Default::notice_update_plugin()
	 * 
	 * @param mixed $site_transient_update_plugins
	 * @return
	 */
	function notice_update_plugin( $site_transient_update_plugins ) {
		unset( $site_transient_update_plugins->response );
		
		return $site_transient_update_plugins;
	}
    
	/**
	 * BDS_Modified_WP_Default::notice_update_theme()
	 * 
	 * @param mixed $site_transient_update_themes
	 * @return
	 */
	function notice_update_theme( $site_transient_update_themes ) {
		unset( $site_transient_update_themes->response );
		
		return $site_transient_update_themes;
	}
    
    /**
     * BDS_Modified_WP_Default::remove_tab()
     * REMOVE OPTIONS AND HELP SETTINGS
     * @return
     */
    function remove_tab() {
        $screen = get_current_screen();
		if( !empty( $screen ) ) {
			$screen->remove_help_tabs();
		}
        
        add_filter( 'screen_options_show_screen' , '__return_false' );
    }
    
    /**
     * BDS_Modified_WP_Default::admin_title()
     * 
     * @param mixed $title
     * @return
     */
    function admin_title( $title ) {
        $title = str_replace( " &#8212; WordPress" , "", $title );
        return $title;
    }
    
    /**
      * BDS_Modified_WP_Default::admin_footer_text()
      * 
      * @param mixed $text
      * @return
      */
     function admin_footer_text( $text ) {
        return sprintf( "&copy; %s", get_bloginfo('name') );
     }
}