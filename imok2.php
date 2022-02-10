<?php
/**
* Plugin Name: imok2
* Plugin URI: http://home/wordpress/imok
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author: Vinman
* Author URI: https://www.emogic.com/
**/

// Enable WP_DEBUG mode
//define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
//define( 'WP_DEBUG_LOG', true );

/* exit if directly accessed */
if ( ! defined( 'ABSPATH' ) ) {
	exit($staus='ABSPATH not defn');
	//die('ABSPATH not defn');
}

// define variable for path to this plugin file.
define( 'imok_PLUGIN_FILE_FULL_PATH' , __file__ );
define( 'imok_LOCATION', dirname( __FILE__ ) );
define( 'imok_LOCATION_URL', plugins_url( '', __FILE__ ) );
define( 'imok_PLUGIN_NAME' , plugin_basename( __FILE__ ) );

class imok {
	//public $plugin_name;

	function __construct() {

		require_once plugin_dir_path(__file__) . 'inc/activate.php' ;
		require_once plugin_dir_path(__file__) . 'inc/deactivate.php' ;
		require_once plugin_dir_path(__file__) . 'inc/admin.php' ;

		$this->enqueue();
	}

	function enqueue(){
		wp_enqueue_script('imokscript' , plugins_url('/assets/imok.js' , __FILE__));
	}

}

if( class_exists('imok') ){
	$imok = new imok();
	}
