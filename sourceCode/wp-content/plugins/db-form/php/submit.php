<?php

require_once('../../../../wp-load.php');

if($_POST['post_id'] == 'submit_front_form'){
	$insert_into = array();
	$insert_value = array();
	
	foreach ($_POST as $key=>$value){
		$insert_into[] = '`'.$wpdb->escape($key).'`';
		$insert_value[] = "'".$wpdb->escape($value)."'";
	}
		
	unset($insert_into[0]);
	unset($insert_into[1]);
	unset($insert_value[0]);
	unset($insert_value[1]);
	
	$insert_into_str = implode(",",$insert_into);
	$insert_value_str = implode(",",$insert_value);
	
	if(get_option('va_db_form_redirect') == 'form'){
		$redirect_dir = $wpdb->escape($_POST['va_db_origin']);
	}else if(get_option('va_db_form_redirect') == 'custom'){
		$redirect_dir = get_option('va_db_form_redirect_location');		
	}
	
	if(get_option('va_db_form_function') == 'd'){
	
		//mysql
		//setup
		$db_host = get_option('va_db_form_host');
		$db_user = get_option('va_db_form_user');
		$db_pw = get_option('va_db_form_pw');
		$db_name = get_option('va_db_form_name');
		$db_table = get_option('va_db_form_table');
		
		//connection
		$db_connect = mysql_connect($db_host, $db_user, $db_pw);
		if(!$db_connect){
			return 'Can\' connect to database.';	
		}
	
		$db_name = mysql_real_escape_string($db_name);
		$db_table = mysql_real_escape_string($db_table);
	
		$insert = mysql_query("INSERT INTO `".$db_name."`.`".$db_table."` (".$insert_into_str.") VALUES (".$insert_value_str.");");
		if(!$insert){
			echo 'QUERY:<br /><br />';
			echo "INSERT INTO `".$db_name."`.`".$db_table."` (".$insert_into_str.") VALUES (".$insert_value_str.");<br /><br />";
			echo "----------<br /><br />";
			echo mysql_errno($db_connect).' : '.mysql_error($db_connect);	
		}else{
			if(get_option('va_db_form_confirmation') == 'checked'){
				$mail_sub = get_option('va_db_form_confirmation_sub');
				$mail_text = get_option('va_db_form_confirmation_content');
				include('mail.php');
			}else{
				$params = array_merge($_GET, array("page_id" => $redirect_dir, "message" => "success"));
				$new_query_string = http_build_query($params);
				echo '<script type="text/javascript">window.location.href = "'.get_bloginfo('url').'?'.$new_query_string.'";</script>';	
			}
		}
		
	}else if(get_option('va_db_form_function') == 'e'){
		$mail_sub = get_option('va_db_form_mail_sub');
		$mail_text = get_option('va_db_form_mail_content');
		include('mail.php');
	}
}



?>