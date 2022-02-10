<?php

namespace inc\admin;

class admin{

	static function add_admin_pages(){
		add_menu_page( 'imok Plugin' , 'imok' , 'manage_options' , 'imok_plugin' , 'inc\admin\admin::admin_index' , 'dashicons-store' , 110 );
	}

	function admin_index(){
		require_once imok_LOCATION . '/templates/admin.php' ;
	}

	function settings_link($links){
		//add custom settings link
		$settings_link = '<a href="admin.php?page=imok_plugin">Settings</a>';
		array_push($links , $settings_link);
		return $links;
	}

}

add_action( 'admin_menu' , array('inc\admin\admin' ,'add_admin_pages') );
add_filter( "plugin_action_links_" . imok_PLUGIN_NAME , array('inc\admin\admin' , 'settings_link') );

