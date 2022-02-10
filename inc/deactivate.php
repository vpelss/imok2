<?php

class deactivate{

	public static function deactivate_plugin(){
		flush_rewrite_rules();
	}

}

register_activation_hook( imok_PLUGIN_FILE_FULL_PATH , array( 'deactivate' , 'deactivate_plugin') );
