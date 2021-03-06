<?php
/**
* Plugin Name: imok2
* Plugin URI: http://home/wordpress
* Description: IMOK for WP.
* Version: 1.0
* Author: The Vinman
* Author URI: https://www.emogic.com/
**/

//XDEBUG_SESSION_START=1

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
define( 'IMOK_PLUGIN_PATH_AND_FILENAME' , __file__ ); // c:\*********\imok2\imok.php
define( 'IMOK_PLUGIN_PATH', dirname( __FILE__ ) ); // c:\************\imok2\
define( 'IMOK_PLUGIN_LOCATION_URL', plugins_url( '', __FILE__ ) ); // http://home/wordpress/wp-content/plugins/imok2
define( 'IMOK_PLUGIN_NAME' , plugin_basename( __FILE__ ) ); // imok2

class imok {

	function __construct() {

		require_once plugin_dir_path(__file__) . 'inc/activate.php' ; //flush , custom post (temp)
		require_once plugin_dir_path(__file__) . 'inc/deactivate.php' ; //flush , custom post (temp)
		require_once plugin_dir_path(__file__) . 'inc/admin.php' ;//add admin page (?empty) , settings links , MOVE TO imok/settings add meta type , user fields , user field write
		require_once plugin_dir_path(__file__) . 'inc/enqueue.php' ;//add js and styles : none

	}

}

if( class_exists('imok') ){
	$imok = new imok();
	}
