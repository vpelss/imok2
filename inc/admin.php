<?php

//namespace inc\admin;

class admin{

	static function add_admin_pages(){
		//add_menu_page( 'imok Plugin' , 'imok' , 'manage_options' , 'imok_plugin' , 'inc\admin\admin::admin_index' , 'dashicons-store' , 110 );
		add_menu_page( 'imok Plugin' , 'imok admin side' , 'manage_options' , 'imok_plugin' , 'admin::admin_index' , 'dashicons-store' , 110 );
	}

	static function admin_index(){//generates html output
		require_once IMOK_PLUGIN_PATH . '/templates/admin.php'; //
	}

	static function settings_link($links){
		//add custom settings link
		$settings_link = '<a href="admin.php?page=imok_plugin">Settings</a>';
		array_push($links , $settings_link);
		return $links;
	}

}

add_action( 'admin_menu' , array('admin' ,'add_admin_pages') );
add_filter( "plugin_action_links_" . IMOK_PLUGIN_NAME , 'admin::settings_link' );

//the imok fields to be added to user profile page
function wp_usermeta_form_fields_imok( $user )
{
    ?>
	<a href='#imok'></a>
	 <h2>IMOK Data</h2>
    <h3>What email(s) would you like to be notified if you are not responsive?</h3>
    <table class="form-table">
        <tr>
            <th>
                <label for="imok_contact_email_1">Contact Email # 1</label>
            </th>
            <td>
                <input type="email"
                       class="regular-text ltr form-required"
                       id="imok_contact_email_1"
                       name="imok_contact_email_1"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'imok_contact_email_1', true ) ) ?>"
                       title="Please enter a valid email address."
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                       required>
            </td>
        </tr>
    </table>
  <table class="form-table">
        <tr>
            <th>
                <label for="imok_contact_email_2">Contact Email # 2</label>
            </th>
            <td>
                <input type="email"
                       class="regular-text ltr"
                       id="imok_contact_email_2"
                       name="imok_contact_email_2"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'imok_contact_email_2', true ) ) ?>"
                       title="Please enter a valid email address."
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                       >
            </td>
        </tr>
    </table>
  <table class="form-table">
        <tr>
            <th>
                <label for="imok_contact_email_3">Contact Email # 3</label>
            </th>
            <td>
                <input type="email"
                       class="regular-text ltr "
                       id="imok_contact_email_3"
                       name="imok_contact_email_3"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'imok_contact_email_3', true ) ) ?>"
                       title="Please enter a valid email address."
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                       >
            </td>
        </tr>
    </table>

	<script type="text/javascript">
		//wp has this turned on???? and there seems no way to show failed sanitized data on server side...
		//maybe try profile_update!
    var commentForm = document.getElementById('your-profile');
    commentForm.removeAttribute('novalidate');
</script>

    <?php
}

// Add the imok fields to user's own profile editing screen.
add_action(
    'show_user_profile',
    'wp_usermeta_form_fields_imok'
);

// Add the imok fields to user profile editing screen.
add_action(
    'edit_user_profile',
    'wp_usermeta_form_fields_imok'
);

//our processing of imok fields added to the user profile form
function wp_usermeta_form_fields_imok_update( $user_id )
{
    // check that the current user have the capability to edit the $user_id
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    // create/update user meta for the $user_id
    return update_user_meta(
        $user_id,
        'imok_contact_email_1',
		is_email( $_POST['imok_contact_email_1'] )
        //$_POST['imok_contact_email_1']
    );

	return update_user_meta(
        $user_id,
        'imok_contact_email_2',
		is_email( $_POST['imok_contact_email_3'] )
        //$_POST['imok_contact_email_1']
    );

	return update_user_meta(
        $user_id,
        'imok_contact_email_3',
		is_email( $_POST['imok_contact_email_3'] )
        //$_POST['imok_contact_email_1']
    );
}

// Add the save action to user's own profile editing screen update.
add_action(
    'personal_options_update',
    'wp_usermeta_form_fields_imok_update'
);

// Add the save action to user profile editing screen update. For admin
add_action(
    'edit_user_profile_update',
    'wp_usermeta_form_fields_imok_update'
);
