<?php
/**
* Plugin Name: Custom Fields Registration For Woocommerce
* Description: This plugin allows create Custom Fields Registration plugin.
* Version: 1.0
* Copyright: 2020
* Text Domain: custom-fields-for-woocommerce-registration
* Domain Path: /languages 
*/


if (!defined('ABSPATH')) {
	exit();
}
if (!defined('CFWR_PLUGIN_NAME')) {
  define('CFWR_PLUGIN_NAME', 'Custom Fields Registration For Woocommerce');
}
if (!defined('CFWR_PLUGIN_VERSION')) {
  define('CFWR_PLUGIN_VERSION', '2.0.0');
}
if (!defined('CFWR_PLUGIN_FILE')) {
  define('CFWR_PLUGIN_FILE', __FILE__);
}
if (!defined('CFWR_PLUGIN_DIR')) {
  define('CFWR_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('CFWR_BASE_NAME')) {
    define('CFWR_BASE_NAME', plugin_basename(CFWR_PLUGIN_FILE));
}
if (!defined('CFWR_DOMAIN')) {
  define('CFWR_DOMAIN', 'custom-fields-for-woocommerce-registration');
}

if (!class_exists('CFWR')) {

	class CFWR {

  	protected static $CFWR_instance;

  	public static function CFWR_instance() {
    	if (!isset(self::$CFWR_instance)) {
      	self::$CFWR_instance = new self();
      	self::$CFWR_instance->init();
      	self::$CFWR_instance->includes();
    	}
    	return self::$CFWR_instance;
    }

    function __construct() {
    	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    	add_action('admin_init', array($this, 'CFWR_check_plugin_state'));
  	}

  	function init() {	   
  		add_action( 'admin_notices', array($this, 'CFWR_show_notice'));   	
    	add_action( 'admin_enqueue_scripts', array($this, 'CFWR_load_admin_script_style'));
    	add_action( 'wp_enqueue_scripts',  array($this, 'CFWR_load_script_style'));
  		add_filter( 'plugin_row_meta', array( $this, 'CFWR_plugin_row_meta' ), 10, 2 );

    }		

    //Load all includes files
    function includes() {
    	include_once('includes/cfwr_comman.php');
      include_once('includes/cfwr_backend.php');
      include_once('includes/cfwr_kit.php');
    	include_once('includes/cfwr_frontend.php');
    }

    function CFWR_load_admin_script_style() {
      wp_enqueue_script( 'jquery-ui-sortable' );
	    wp_enqueue_style( 'cfwr-backend-css', CFWR_PLUGIN_DIR.'/assets/css/cfwr_backend_css.css', false, '1.0' );
   	  wp_enqueue_script( 'cfwr-backend-js', CFWR_PLUGIN_DIR.'/assets/js/cfwr_backend_js.js', array( 'jquery', 'select2') );
    	wp_localize_script( 'ajaxloadpost', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    	wp_enqueue_style( 'woocommerce_admin_styles-css', WP_PLUGIN_URL. '/woocommerce/assets/css/admin.css',false,'1.0',"all");
      wp_localize_script('cfwr-backend-js', 'remove_icon', array(
        'icon' => CFWR_PLUGIN_DIR.'/images/remove_icon.png',
      ));
    }


    function CFWR_load_script_style() {
    	wp_enqueue_style( 'cfwr-frontend-css', CFWR_PLUGIN_DIR.'/assets/css/cfwr_frontend_css.css', false, '1.0' );
    }

    function CFWR_show_notice() {
    	if ( get_transient( get_current_user_id() . 'wfcerror' ) ) {
    		deactivate_plugins( plugin_basename( __FILE__ ) );
    		delete_transient( get_current_user_id() . 'wfcerror' );
    		echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';
    	}
  	}

    function CFWR_plugin_row_meta( $links, $file ) {
      if ( CFWR_BASE_NAME === $file ) {
        $row_meta = array(
          'rating'    =>  '<a href="https://xthemeshop.com/custom-fields-registration-for-woocommerce/" target="_blank">Documentation</a> | <a href="https://xthemeshop.com/contact/" target="_blank">Support</a> | <a href="https://wordpress.org/support/plugin/custom-fields-registration-for-woocommerce/reviews/?filter=5" target="_blank"><img src="'.CFWR_PLUGIN_DIR.'/images/star.png" class="cfwr_rating_div"></a>'
        );
        return array_merge( $links, $row_meta );
      }
      return (array) $links;
    }

    function CFWR_check_plugin_state(){
  		if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
    		set_transient( get_current_user_id() . 'wfcerror', 'message' );
  		}
  	}

	}
	add_action('plugins_loaded', array('CFWR', 'CFWR_instance'));  	
}

add_action( 'plugins_loaded', 'CFWR_load_textdomain' );
 
function CFWR_load_textdomain() {
    load_plugin_textdomain( 'custom-fields-for-woocommerce-registration', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function CFWR_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'custom-fields-for-woocommerce-registration' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'CFWR_load_my_own_textdomain', 10, 2 );

?>