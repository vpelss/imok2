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
define( 'imok_LOCATION', dirname( __FILE__ ) );
define( 'imok_LOCATION_URL', plugins_url( '', __FILE__ ) );

class imok {
	function __construct() {
		//https://www.php.net/manual/en/language.types.callable.php
		register_activation_hook( __file__ , array( $this , 'activate') );
		register_deactivation_hook( __file__ , array( $this , 'deactivate') );
		//register uninstall
		register_uninstall_hook( __file__ , array( $this , 'imok_uninstall') );

		do_action( 'qm/debug', 'End of the start' );

		add_action( 'init' , array( $this , 'custom_post_type') );
		$this->enqueue();
	}

	function activate(){
		$this->custom_post_type(); //failsafe precaution only
		flush_rewrite_rules();
	}

	function deactivate(){
		flush_rewrite_rules();
	}

	static function imok_uninstall(){
		//clear stored data
		do_action( 'qm/debug', 'This happened!' );
/*
		$books = get_posts( array('book_type' => 'book' , 'numberposts' => -1) );
		foreach($books as $book){
			wp_delete_post( $book->ID , true );
		}
*/
		do_action( 'qm/debug', 'That happened!' );

		global $wpdb;
		$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
		$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT ID FROM wp_posts)");
		$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT ID FROM wp_posts)");

	}

	function custom_post_type(){
		register_post_type( 'book' , ['public' => true , 'label' => 'BOOK'] );

	}

	function enqueue(){
		wp_enqueue_script('imokscript' , plugins_url('/assets/imok.js' , __FILE__));
	}

}

if( class_exists('imok') ){
	$imok = new imok();
	}
