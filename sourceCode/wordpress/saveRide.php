<?php 
		
		$curDate="2/05/2013";
		$curDay="2";
		$link = mysql_connect('localhost', 'root', '');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
			
			}
			
			$src=$_GET["source"]; 
			$dst=$_GET["dest"]; 
			$d=$_GET["d"]; 	
			$m=$_GET["m"]; 
			$y=$_GET["y"]; 
			$h=$_GET["h"]; 
			$min=$_GET["min"]; 
			$daily=$_GET["daily"]; 
			$id=$_GET["user_id"]; 
			$cap=$_GET["cap"]; 
			$cost=$_GET["cost"]; 
			$sun=$_GET["sun"]; 
			$mon=$_GET["mon"]; 
			$tue=$_GET["tue"]; 
			$wed=$_GET["wed"]; 
			$thur=$_GET["thur"]; 
			$fri=$_GET["fri"]; 
			$sat=$_GET["sat"]; 

			
			if($sun=="")
			{
				$sun=0;
			}
			if($mon=="")
			{
				$mon=0;
			}
			if($tue=="")
			{
				$tue=0;
			}if($wed=="")
			{
				$wed=0;
			}if($fri=="")
			{
				$fri=0;
			}if($sat=="")
			{
				$sat=0;
			}if($thur=="")
			{
				$thur=0;
			}
			
			 $dbhost = "localhost";
			 $dbname = "test";
			 $dbpass = "";
			 $dbuser = "root";
			
			$connect = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);
				if (mysqli_connect_errno($connect))
				{
					echo "We could not connect to the server. Please try again later!";
				}			
				

			
			$time=$h.':'.$min;
			$date=$d.'/'.$m.'/'.$y;
			echo $date;
			if($daily=="")
			{
				$daily=0;
			}
			
			$sql="INSERT INTO tripInfo (offeredBy,src, dest, date, time,daily,matched,isAvailable,cap,cost,sun,mon,tue,wed,thur,fri,sat) VALUES ($id,'$src','$dst','$date',' $time',$daily,0,1,$cap,$cost,$sun,$mon,$tue,$wed,$thur,$fri,$sat);";
			echo $sql;
			if (!mysqli_query($connect,$sql))
					{
						die('Error: ' . mysqli_error($connect));
					}
			
			$link = mysql_connect('localhost', 'root', '');
				if (!$link) 
				{
					die('Could not connect: ' . mysql_error());	
				}
			mysql_select_db('test', $link) or die('Could not select database.');	
			
			$sql="select * from tripInfo where trip_id in (select max(trip_id) from tripInfo);";
			$res=mysql_query($sql);	
			
			if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
}
			while ($row = mysql_fetch_assoc($res)) 
				{
				$provider_trip=$row['trip_id'];
				echo $provider_trip;
				echo "im insode";
				}
				
			$sql="INSERT INTO trip_map (user_id,trip_id) VALUES ($id,$provider_trip);";
			mysql_query($sql);	
			$sql="Select * from tripInfo where '$_GET[source]'=src and '$_GET[dest]'=dest and taker=1 and ('$date'=date or (sun=$sun and $sun!=0) or (mon=$mon and $mon!=0) or (tue=$tue and $tue!=0) or (wed=$wed and $wed!=0) or (fri=$fri and $fri!=0) or (sat=$sat and $sat!=0))  and isAvailable=1;";
			
			echo $sql;
				$res=mysql_query($sql);
			    if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
}
			
				while ($row = mysql_fetch_assoc($res)) 
				{
				
					echo "Your id:";
					if($time-$row['time'] == 0 and $user_id!=$row['offeredBy'])
					{
						echo "seats available";
						echo "$row[time]";
						$sql="update tripInfo set matched=1 ,cap=".$cap." where trip_id=".$row['trip_id'].';';
						echo $sql."\n";
						$res=mysql_query($sql);
						if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
					}
						$sql="update tripInfo set matched=1 ,cap=".$cap." where trip_id=$provider_trip;";
						$res=mysql_query($sql);
						echo $sql."\n";

						if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
					}
						$sql="INSERT INTO trip_match (provider_id,taker_id,provider_trip,taker_trip) VALUES ($id,$row[offeredBy],$row[trip_id],$provider_trip);";
						echo $sql."\n";

						$res=mysql_query($sql);
						if (!$res) {
						$message  = 'Invalid query: ' . mysql_error() . "\n";
						$message .= 'Whole query: ' . $sql;
						die($message);
					}
					
				}
				
								
		}
			
			//header( 'Location: http://localhost/wordpress/?page_id=11&user_id='.$user_id	 ); // ID of my trips page
			header( 'Location: http://localhost/wordpress/mytrips.php?user_id= '.$_GET['user_id'] ); // ID of home page

					
					
				
		mysql_close($link);

?>.<br>