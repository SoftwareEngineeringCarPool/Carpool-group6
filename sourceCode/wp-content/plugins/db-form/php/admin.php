<?php


//ADMIN SETUP
function db_form_add_admin() {
	//add page
	add_submenu_page('options-general.php','db form settings', 'db form', 'manage_options', 'db_form_admin', 'db_form_admin_layout');
	//declare options
	add_action('admin_init','update_va_db_form_settings');
	
}
add_action('admin_menu' , 'db_form_add_admin');

//UPDATER
function update_va_db_form_settings(){
	register_setting( 'va_db_form_settings', 'va_db_form_function' );
	register_setting( 'va_db_form_settings', 'va_db_form_host' );
	register_setting( 'va_db_form_settings', 'va_db_form_user' );
	register_setting( 'va_db_form_settings', 'va_db_form_pw' );
	register_setting( 'va_db_form_settings', 'va_db_form_name' );
	register_setting( 'va_db_form_settings', 'va_db_form_table' );
	
	register_setting( 'va_db_form_settings', 'va_db_form_mail' );
	register_setting( 'va_db_form_settings', 'va_db_form_mail_sub' );
	register_setting( 'va_db_form_settings', 'va_db_form_mail_content' );
	register_setting( 'va_db_form_settings', 'va_db_form_confirmation' );
	register_setting( 'va_db_form_settings', 'va_db_form_confirmation_sub' );
	register_setting( 'va_db_form_settings', 'va_db_form_confirmation_content' );
	
	register_setting( 'va_db_form_settings', 'va_db_form_hide' );
	register_setting( 'va_db_form_settings', 'va_db_form_redirect' );
	register_setting( 'va_db_form_settings', 'va_db_form_redirect_location' );
	register_setting( 'va_db_form_settings', 'va_db_form_mes_success' );
	
	register_setting( 'va_db_form_settings', 'va_db_form_style' );
}

//ADMIN MENU LAYOUT 
function db_form_admin_layout() {
	$db_form_action = $_GET['db-form-action'];
	?>
    <div class="wrap">
		<div id="icon-va-db-form" class="icon32"></div><h2>db form plugin</h2>

		<form method="post" action="options.php">
        <?php settings_fields( 'va_db_form_settings' ); ?>
        <?php if(function_exists(do_settings)){do_settings( 'va_db_form_settings' );} ?>
        <input type="hidden" name="post_id" value="submit_admin_setup" />
        <p>A simple plugin to create forms submitting data to a given database.</p>
        <p>You will create your form using <a href="http://www.valentinalisch.de/dev_wp/db-form/#shortcodes" target="_blank">simple shortcodes</a><br />It's important that all your data below is correct.</p>
        <h3>Setup</h3>
        	<table class="form-table setup">
                <tr valign="top">
                    <th scope="row">
                    	<label>Function</label>
                    </th>
                    <td>
                    	<select name="va_db_form_function" size="1" onchange="va_db_form_switch_fields(this);">
                        	<?php if(get_option('va_db_form_function') == 'd'){
                        		echo '<option value="d" selected>write to database</option><option value="e">send e-mail</option>';
							}else{
								echo '<option value="d">write to database</option><option value="e" selected>send e-mail</option>';
							}?>
                        </select>
                    </td>
				</tr>
                <tr valign="top" class="d <?php if(get_option('va_db_form_function') == 'e'){echo 'hidden';} ?>" >
                    <th scope="row">
                    	<label>DB Host</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_host" value="<?php echo get_option('va_db_form_host') ?>" />
                    </td>
				</tr>
                <tr valign="top" class="d <?php if(get_option('va_db_form_function') == 'e'){echo 'hidden';} ?>" >
                    <th scope="row">
                    	<label>DB User</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_user" value="<?php echo get_option('va_db_form_user') ?>" />
                    </td>
				</tr>
                <tr valign="top" class="d <?php if(get_option('va_db_form_function') == 'e'){echo 'hidden';} ?>" >
                    <th scope="row">
                    	<label>DB Password</label>
                    </th>
                    <td>
                    	<input type="password" name="va_db_form_pw" value="<?php echo get_option('va_db_form_pw') ?>" />
                    </td>
				</tr>
                <tr valign="top" class="d <?php if(get_option('va_db_form_function') == 'e'){echo 'hidden';} ?>" >
                   	<th scope="row">
                    	<label>DB Name</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_name" value="<?php echo get_option('va_db_form_name') ?>" />
                	</td>
				</tr>
                <tr valign="top" class="d <?php if(get_option('va_db_form_function') == 'e'){echo 'hidden';} ?>" >
                   	<th scope="row">
                    	<label>DB Table</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_table" value="<?php echo get_option('va_db_form_table') ?>" />
                	</td>
				</tr>
                <tr valign="top" >
                   	<th scope="row">
                    	<label>E-Mail</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_mail" value="<?php echo get_option('va_db_form_mail') ?>" />
                        <p class="description">Only required for e-mail function and confirmation mail.</p>
                	</td>
				</tr>
			</table>
            <table class="form-table configuration">
            <h3>Configuration</h3>
                <tr valign="top" class="e <?php if(get_option('va_db_form_function') == 'd'){echo 'hidden';} ?>">
                   	<th scope="row">
                    	<label>E-Mail subject</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_mail_sub" value="<?php echo get_option('va_db_form_mail_sub') ?>" />
                	</td>
				</tr>
                <tr valign="top" class="e <?php if(get_option('va_db_form_function') == 'd'){echo 'hidden';} ?>">
                    <th scope="row">
                    	<label>E-mail content</label>
                    </th>
                    <td>
                    	<textarea style="width:400px; height: 150px; resize:none;" name="va_db_form_mail_content"><?php echo get_option('va_db_form_mail_content') ?></textarea>
                        <p class="description">You can use your "name-attributes" as variables in this section.<br />Use %name-attribute%<br />You can find some examples right <a href="http://www.valentinalisch.de/dev_wp/db-form/#mail_examples" target="_blank">here (external link).</a></p>
                    </td>
				</tr>
                <tr valign="top">
                    <th scope="row">
                    	<label></label>
                    </th>
				</tr>
                <tr valign="top">
                    <th scope="row">
                    	<label>Send myself an email confirmation</label>
                    </th>
                    <td>
                    	<input type="checkbox" name="va_db_form_confirmation" value="checked" <?php echo get_option('va_db_form_confirmation') ?> />
                    </td>
				</tr>
                <tr valign="top">
                   	<th scope="row">
                    	<label>E-Mail confirmation subject</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_confirmation_sub" value="<?php echo get_option('va_db_form_confirmation_sub') ?>" />
                	</td>
				</tr>
                <tr valign="top">
                    <th scope="row">
                    	<label>E-mail confirmation content</label>
                    </th>
                    <td>
                    	<textarea style="width:400px; height: 150px; resize:none;" name="va_db_form_confirmation_content"><?php echo get_option('va_db_form_confirmation_content') ?></textarea>
                        <p class="description">You can use your "name-attributes" as variables in this section.<br />Use %name-attribute%<br />You can find some examples right <a href="http://www.valentinalisch.de/dev_wp/db-form/#mail_examples" target="_blank">here (external link).</a></p>
                    </td>
				</tr>
                <tr valign="top">
                    <th scope="row">
                    	<label></label>
                    </th>
				</tr>
                <tr valign="top" class="no_c <?php if(get_option('va_db_form_redirect') == 'custom'){echo 'hidden';} ?>">
                    <th scope="row">
                    	<label>Hide form after submission</label>
                    </th>
                    <td>
                    	<input type="checkbox" name="va_db_form_hide" value="checked" <?php echo get_option('va_db_form_hide') ?> />
                    </td>
				</tr>
                <tr valign="top">
                    <th scope="row">
                    	<label>Redirect after submission</label>
                    </th>
                    <td>
                    	<select name="va_db_form_redirect" size="1" onchange="va_db_form_switch_fields(this);">
                        	<?php if(get_option('va_db_form_redirect') == 'form'){
								echo '<option value="form" selected>form page</option><option value="custom">custom</option>';	
							}else{
								echo '<option value="form">form page</option><option value="custom" selected>custom</option>';
							} ?>
                        </select>
                    </td>
				</tr>
              	<tr valign="top" class="c <?php if(get_option('va_db_form_redirect') != 'custom'){echo 'hidden';} ?>">
                    <th scope="row">
                    	<label>Redirect to:</label>
                    </th>
                    <td>
                    	<input type="text" name="va_db_form_redirect_location" value="<?php echo get_option('va_db_form_redirect_location') ?>" />
                    </td>
				</tr>
                <tr valign="top" class="no_c <?php if(get_option('va_db_form_redirect') == 'custom'){echo 'hidden';} ?>">
                    <th scope="row">
                    	<label>Success message</label>
                    </th>
                    <td>
                    	<textarea style="width:400px; height: 150px; resize:none;" name="va_db_form_mes_success"><?php echo get_option('va_db_form_mes_success') ?></textarea>
                    </td>
				</tr>
			</table>
            <table class="form-table styling" id="db-form-style">
            <h3>Styling</h3>
                <tr valign="top">
                    <th scope="row">
                    	<label>Stylesheet</label>
                    </th>
                    <td>
                    	<?php
						$handle = plugins_url( 'db-form-assets/');
						$handle_arr = parse_url($handle);
						
						$path = $_SERVER['DOCUMENT_ROOT'].$handle_arr['path'];
						if(!is_dir($path)){
							if($db_form_action == 'create-style'){
								if(!mkdir($path)){
									?>
									<p class="db-form-error">Error:<br />
									PlugIn was not able to create the "db-form-assets" folder in your plugin directory.<br />
                                    Please create it yourself.</p>
                                    <?php
								}	
							}else{
								$params = array_merge($_GET, array("db-form-action" => "create-style"));
								$new_query_string = http_build_query($params);
								?>
								<p class="db-form-note">Note:<br />
								You haven't created a folder called "db-form-assets" in your plugin directory yet<br />
								This folder is needed to use custom stylesheets with this plugIn. <br />
								<a href="<?php echo '?'.$new_query_string; ?>#db-form-style">Create the folder now.</a></p>
								<?php
							}
						}
						?>
                    	<select name="va_db_form_style" size="1">
                        	<option value="<?php echo plugins_url( 'style/front/standard.css' , dirname(__FILE__) ); ?>">standard.css</option>
                        <?php 
						
						if(is_dir($path)){
							$files = scandir($path);
							for ($i = 2; $i <= count($files)-1; $i++){
								if(substr($files[$i],-4,4) == '.css'){
									echo '<option value="'.$handle.$files[$i].'" '.selected($handle.$files[$i],get_option('va_db_form_style')).'>'.$files[$i].'</option>';
								}
							}
						}
						?>	
                        </select>
                        <p class="description">Select which stylesheet should be used. Upload stylesheets to the "db-form-assets/" folder in your plugin directory.</p>
                    </td>
				</tr>
			</table>
            <p class="submit">
            	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
		</form>
	</div>
	<?php

}

?>