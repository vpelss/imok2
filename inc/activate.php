<?php

class activate{

	public function activate_plugin(){
		flush_rewrite_rules();
	}

	static function custom_post_type(){
		register_post_type( 'imok' , ['public' => true , 'label' => 'IMOK'] );
	}

}

register_activation_hook( imok_PLUGIN_FILE_FULL_PATH , array( 'activate' , 'activate_plugin') );

add_action( 'init' , 'activate::custom_post_type' );


