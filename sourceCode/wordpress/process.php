<?php

$trip = $_GET['id'];
$confirm = $_GET['confirm'];
$button = $_GET['agree'];
$user = $_GET['user_id'];
//echo $user;

$link = mysql_connect('localhost', 'root', '');
	if (!$link) 
	{
		die('Could not connect: ' . mysql_error());	
	}

mysql_select_db('test', $link) or die('Could not select database.');




	if ($trip == NULL)
	{
		echo "Error: Enter a trip ID";
		//relocation code here
	}
	if ($confirm == "Confirm")
	{	
		$query0 = 'Select * from trip_map where trip_id = ' . $trip .';';
		$result0 =mysql_query( $query0 , $link);
		$val = 0;
		while ($row0 = mysql_fetch_assoc($result0))
		{
			//echo $row0['user_id'];
			if($row0['user_id'] == $user) 
			{
				$val=1;
			}
		}
	
		$query1 = 'Select * from tripInfo where trip_id = ' . $trip .';';
		$result1 =mysql_query( $query1 , $link);
		
		while ($row1 = mysql_fetch_assoc($result1))
		{
			if ($val != 1)
			{
				echo "ERROR: You can not confirm this ride";
			}		
			else if($row1['isAvailable'] == 0) 
			{
				echo "ERROR: Trip is not available";
			}
			else if ($row1['confirm'] == 1)
			{
				echo "ERROR: Trip is already confirmed";
			}
			else
			{
				$query = 'UPDATE tripInfo set confirm=1 WHERE trip_id=' .$trip .';';
				if (mysql_query( $query , $link))
				{ echo "<br>Ride confirmed";}
				else 
				{echo "could not confirm ride";}
			}
		}
	}
	else if ($confirm == "Cancel")
	{
		$query0 = 'Select * from trip_map where trip_id = ' . $trip .';';
		//echo $query0;
		$result0 =mysql_query( $query0 , $link);
		$val = 0;
		while ($row0 = mysql_fetch_assoc($result0))
		{
			//echo $row0['user_id'];
			if($row0['user_id'] == $user) 
			{
				$val=1;
				
			}
			else
			{
				echo "ERROR: You can not cancel this ride";
			}
		}
		if ($val == 1)
		{
			$query = 'UPDATE tripInfo set isAvailable=0 WHERE trip_id=' .$trip .';';
			//echo $query;
			if (mysql_query( $query , $link))
			{
				echo "<br>Ride cancelled";
				$q2 = 'Select * from tripInfo where trip_id = ' . $trip .';';
				$result =mysql_query( $q2 , $link);
									
				while ($row = mysql_fetch_assoc($result)) 
				{
					echo $row['trip_id'];
					if ($row['taker'] == 0)
					{
						$q3 = 'Select * from tripInfo where tripInfo.trip_id in (Select taker_trip from trip_match, trip where provider_trip = ' . $trip . ');';
						$res =mysql_query( $q3 , $link);
						echo $q3;
	
						while ($r = mysql_fetch_assoc($res))
							{

								$query = 'UPDATE tripInfo set matched=0 WHERE trip_id=' .$r['trip_id'] .';';
								$result =mysql_query( $query , $link);
								$query = 'delete from trip_match set matched=0 WHERE trip_id=' .$r['trip_id'] .';';
								$result =mysql_query( $query , $link);
								

							}
						}
						else
						{
						$q3 = 'Select * from tripInfo where tripInfo.trip_id in (Select provider_trip from trip_match, trip where taker_trip = ' . $trip . ');';
						$res =mysql_query( $q3 , $link);	

						while ($r = mysql_fetch_assoc($res))
							{

								$query = 'UPDATE tripInfo set matched=0 WHERE trip_id=' .$r['trip_id'] .';';
								$result =mysql_query( $query , $link);
								$query = 'delete from trip_match set matched=0 WHERE trip_id=' .$r['trip_id'] .';';
								$result =mysql_query( $query , $link);


							}
						}
					}
				}
				
			}
			else
				{echo "could not cancel";}

		}
	
	else
	{ echo "404 page not available";}
header( 'Location: http://localhost/wordpress/mytrips.php?user_id='.$_GET['user_id'] ); // ID of home page

function findMatch($row,$that_row)
{
echo "im in";
echo $row['trip_id'];
echo $that_row['trip_id'];
					if( ($row['taker']==0  )&& $row['time']-$that_row['time'] == 0 && $row['taker'] != $that_row['taker'])
					{
						$cap=$row['cap']-1;
						$sql="update tripInfo set matched=1 ,cap=".$cap." where trip_id=".$row['trip_id'].';';
						echo $sql."\n";
						$res=mysql_query($sql);
						if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
					}
						$sql="update tripInfo set matched=1 where trip_id=".$that_row['trip_id'];
						$res=mysql_query($sql);
						echo $sql."\n";

						if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
					}
						$sql="INSERT INTO trip_match (taker_id,provider_id,taker_trip,provider_trip) VALUES ($id,".$row[offeredBy].",".$that_row['trip_id'].",".$row[trip_id].")";
						echo $sql."\n";

						$res=mysql_query($sql);
						if (!$res) {
						$message  = 'Invalid query: ' . mysql_error() . "\n";
						$message .= 'Whole query: ' . $sql;
						die($message);
					}
					
				}
				
				if( $row['time']-$that_row['time'] == 0 && $row['taker'] != $that_row['taker'] && $row['cap'] > 0 && $row['taker']==0)
				{
					$cap=$that_row['cap']-1;
						$sql="update tripInfo set matched=1 ,cap=".$cap." where trip_id=".$that_row['trip_id'].';';
						echo $sql."\n";
						$res=mysql_query($sql);
						if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
					}
						$sql="update tripInfo set matched=1  where trip_id=".$row['trip_id'];
						$res=mysql_query($sql);
						echo $sql."\n";

						if (!$res) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $sql;
					die($message);
					}
						$sql="INSERT INTO trip_match (taker_id,provider_id,taker_trip,provider_trip) VALUES (".$id.",".$row[offeredBy].",".$that_row['trip_id'].",".$row[trip_id].");";
						echo $sql."\n";

						$res=mysql_query($sql);
						if (!$res) {
						$message  = 'Invalid query: ' . mysql_error() . "\n";
						$message .= 'Whole query: ' . $sql;
						die($message);
					}
					
				}
				
		
		
		}
?>