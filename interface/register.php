<html>
	<Title> Welcome to Carpool </title>
	
		Congratulations <br>
		
		
		<?php
		
			 $dbhost = "localhost";
			 $dbname = "carpool";
			 $dbpass = "car";
			 $dbuser = "carpool";
	/*		 $name = "Mohsin";
			 $pass = "Ali";
			 $email = "gender";
			 $gender = "M";
			 $preff = "F";
	*/	
			
			$connect = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);
				if (mysqli_connect_errno($connect))
				{
					echo "We could not connect to the server. Please try again later!";
				}
	
			class User	{
				public $name;
				public $pass;
				public $email;
				public $gender;
				public $preff;
				
				function __construct() {
				
				$name = $_GET['name'];
				$pass = $_GET['pwd'];
				$email = $_GET['email'];
				$gender = $_GET['sex'];
				$preff = $_GET['sex1'];
				
				echo $name;
				
				}
				
			
				function add($connect) {
				$sql="INSERT INTO users(name, password, email, gender, pref) VALUES ('$_GET[name]', '$_GET[pwd]', '$_GET[email]', '$_GET[sex]', '$_GET[sex1]')";
				if (!mysqli_query($connect,$sql))
					{
					die('Error: Could not add record in to the database');
					}
				echo " You have been added to our database";
				}
			}
		
			$obj = new User();
			$obj->add($connect);
		
		?>

		<input type="button" name="b1" value="Go Back" onClick="location.href ='welcomepage.php'" >
		
</html>