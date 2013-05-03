[php]
////////////////////making the function to match all possible lifts/////////////////////////////
$link = mysql_connect("localhost", "root", "");
	if (!$link) 
	{
		die("Could not connect: " . mysql_error());	
	}

mysql_select_db("test", $link) or die("Could not select database.");


$sql="select * from tripInfo where matched=0 and isAvailable=1;";
$result =mysql_query( $sql , $link);
while ($trips = mysql_fetch_assoc($result)) // looping for all trips legit trips
{
$take=$trips['taker'];
$dst=$trips["dest"];
$src=$trips["src"];
$date=$trips["date"];
	$sql="select * from tripInfo where matched=0 and isAvailable=1 and taker!=$take and dest='$dst' and src='$src' and date='$date' and ( cap>0 or taker=1);";
echo $sql;
	$res=mysql_query( $sql , $link);
	while($coTrips=mysql_fetch_assoc($res)) // looping for all trips that match with current trip
	{
		$uid=$coTrips["trip_id"];
		$uid1=$trips["trip_id"];
		$take1=$coTrips["taker"];
		$take2=$trips["taker"];
		$sql="update tripInfo set matched=1 where trip_id=$uid or trip_id=$uid1;";
		$res=mysql_query( $sql , $link);
		$sql="select user_id from trip_map where trip_id=$uid;";
		$sql1="select user_id from trip_map where trip_id=$uid1;";
		$res=mysql_query( $sql , $link);
		$res1=mysql_query( $sql1 , $link);
		while($u1=mysql_fetch_assoc($res))
		{
			$user1=$u1["user_id"];
		}
		while($u2=mysql_fetch_assoc($res1))
		{
			$user2=$u2["user_id"];
		}
		if($take1==1)
		{
			$sql="INSERT INTO trip_match (taker_id,provider_id,taker_trip,provider_trip) VALUES ($user1,$user2,$uid,$uid1)";
			$res1=mysql_query( $sql , $link);
		}
		else
		{
			$sql="INSERT INTO trip_match (taker_id,provider_id,taker_trip,provider_trip) VALUES ($user2,$user1,$uid1,$uid)";
			$res1=mysql_query( $sql , $link);
		}

	}
}

$user_id = $_GET["user_id"];
		$link = mysql_connect("localhost", "root", "");
		if (!$link) {
			die("Could not connect: " . mysql_error());	
			}
			
			mysql_select_db("test", $link) or die("Could not select database.");
			$q1 = "Select * from tripInfo where tripInfo.trip_id in (Select trip_map.trip_id from trip_map where user_id =" . $user_id .");";
			$res=mysql_query($q1 , $link);
			
			if ($res == NULL)
			{
				echo "You have no trips at the moment";
				echo "<br>";
			}
			else
			{
				while ($row = mysql_fetch_assoc($res)) 
				{
					if ($row["isAvailable"] == 1)
					{
						echo "Trip ID: " . $row["trip_id"] . "<br>";
						echo "Source-Destination: " . $row["src"] . "-";
						echo $row["dest"] . "<br>";
						echo "Date: " . $row["date"] . "     Time: ";
						echo $row["time"] . "<br>";
						echo "Your Status: " ; 
							if ($row["confirm"] == 0)
							{ echo "Not confirmed <br>";}
							else
							{ echo "Confirmed <br>";}
				
				
						if ($row["matched"]== 1)
						{
							echo "<br>"."A match has been found" ;
							if ($row["taker"] == 0)
							{
								$find = $row["trip_id"];
								echo "<br>";
							$query = "Select * from users where users.user_id in (Select taker_id from trip_match, trip where provider_trip = " . $find . ");";
								$result =mysql_query( $query , $link);
								
								while ($r = mysql_fetch_assoc($result)) 
								{
									echo "Your share a lift with: <br> ";
									echo "User Name: " . $r["name"] . "<br>";
									echo "Gender: " . $r["gender"] . "<br>";									
									echo "Email: " . $r["email"] . "<br>";
								}
								
						$q2 = "Select * from tripInfo where tripInfo.trip_id in (Select taker_trip from trip_match, tripInfo where provider_trip = " . $find . ");";
								$result2 =mysql_query( $q2 , $link);
										
								while ($r2 = mysql_fetch_assoc($result2)) 
								{
									echo "Status: ";
									if ($r2["confirm"] == 0 && $r2["isAvailable"] == 1)
									{ echo "Not confirmed <br>";}
									else if ($r2["confirm"] == 1 && $r2["isAvailable"] == 1)
									{ echo "Confirmed <br>";}
									else
									{ echo "Cancelled <br>";}
								}

							}
						}
					
					}
				}
			}
			

[/php]


<html>
<body>
<form action="process.php" method="GET">
	Ride: <input type="text" name="id" size="10" />
    <br>
  <input type="radio" name="confirm" value="Confirm" > Confirm <br>
  <input type="radio" name="confirm" value="Cancel"> Cancel <br>
  <input  type="hidden" name="user_id" value="<?php echo $user_id;?>" > <br>
  <input type="submit" name="agree" value="Submit">
</form>
</body>
</html>