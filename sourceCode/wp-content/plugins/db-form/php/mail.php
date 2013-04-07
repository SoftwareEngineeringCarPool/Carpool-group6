<?php

//mail
preg_match_all('/%(.*)%/U', $mail_text, $matches);
		
$mail_loop = count($matches[0]);
for($m=0; $m<$mail_loop; $m++){
	$match = $matches[0][$m];
	$replace = $_POST[$matches[1][$m]];
	$mail_text = str_replace($match,$replace,$mail_text);
}
		
//setup
$mail_rec = get_option('va_db_form_mail');
$mail_sender = "From: ".get_bloginfo('name')." < ".get_bloginfo('admin_email')." >\n";
$mail_sender .= "Content-Type: text/html\n";
$mail_sender .= "Content-Transfer-Encoding: 8bit\n";
		
$message = nl2br($mail_text);
		
//send
if(mail($mail_rec, $mail_sub, $message, $mail_sender)){
	$params = array_merge($_GET, array("page_id" => $redirect_dir, "message" => "success"));
	$new_query_string = http_build_query($params);
	echo '<script type="text/javascript">window.location.href = "'.get_bloginfo('url').'?'.$new_query_string.'";</script>';	
}

?>