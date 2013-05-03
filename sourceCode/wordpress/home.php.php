<?php 
	$var=$_GET["name"]; 
	if($var!="root")
	{
		echo $var;
		header("Location: localhost");
	}
?>.<br>