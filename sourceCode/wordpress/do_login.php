<?php 
	$name=$_GET["name"]; 
	$pwd=$_GET["pwd"]; 
	
	$user_id="420";
	echo $name;
	echo $pwd;
		$link = mysql_connect('localhost', 'root', '');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
			
			}
			
			mysql_select_db('test', $link) or die('Could not select database.');
			$sql='Select * from users where name= \''. $name.'\' and password=\''.$pwd.'\';';
			$res=mysql_query($sql );
			echo $name."\n";
			echo $pwd;
			echo $sql;
	
			$check=0;
		while ($row = mysql_fetch_assoc($res)) 
		{		
				$user_id=$row['user_id'];
				header( 'Location: http://localhost/wordpress/?page_id=85&user_id='.$user_id ); // ID of home page
				$check=1;
		}
			
		if($check==0)
		{
								header( 'Location: http://localhost/wordpress/?page_id=101 ');// ID of login  page

		}

		echo 'Connected successfully';
		mysql_close($link);

?>.<br>