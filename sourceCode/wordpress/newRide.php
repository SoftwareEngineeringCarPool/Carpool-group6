<?php 

	$user_id=$_GET['user_id'];
	echo $user_id;
	header( 'Location: http://localhost/wordpress/?page_id=11&user_id='.$user_id	 ); // ID of home page
	
?>.<br>