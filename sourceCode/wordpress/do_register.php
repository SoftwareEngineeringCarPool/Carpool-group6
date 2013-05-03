
		<?php

			 $dbhost = "localhost";
			 $dbname = "test";
			 $dbpass = "";
			 $dbuser = "root";
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
				public $roll;
				public $error;

				function __construct() {

				$this->name = $_GET['name'];
				$this->pass = $_GET['pwd'];
				$this->roll = $_GET['roll'];
				$this->email = $_GET['email'];
				$this->gender = $_GET['sex'];
				$this->preff = $_GET['sex1'];
	
				}
				
				function check()    // performs all sanity checks.
				{
					$chk= 0;
					if ($this->name == NULL)	// checks if name is not an empty string
					{
						header( 'Location: http://localhost/wordpress/?page_id=15&error_id=1'); // ID of home page
					}
					
					else if ( strlen($this->pass) < 6)	//checks that password length is not less than 6
					{ 
						header( 'Location: http://localhost/wordpress/?page_id=15&error_id=2'); // ID of home page
					}
					
					else if ((!is_numeric($this->roll)) || (strlen($this->roll) !=8)) // checks if is a valid roll number
					{
						header( 'Location: http://localhost/wordpress/?page_id=15&error_id=3'); // ID of home page
					}
					
					else if (((substr($this->email,0,8)) != $this->roll) || (substr($this->email, -12) != '@lums.edu.pk') || (strlen($this->email) != 20)) //checks valid email id
					{
						header( 'Location: http://localhost/wordpress/?page_id=15&error_id=4'); // ID of home page;
						
					}
					else
					{
					$chk=1;
					}
					return $chk;
				}

				function add($connect) {
				$sql="INSERT INTO users(roll, name, password, email, gender, pref) VALUES ('$_GET[roll]','$_GET[name]', '$_GET[pwd]', '$_GET[email]', '$_GET[sex]', '$_GET[sex1]')";
				echo $sql;
				if (!mysqli_query($connect,$sql))
					{
						die('Error: ' . mysqli_error($connect));
					}
				echo " You have been added to our database";
				
				$link = mysql_connect('localhost', 'root', '');
				if (!$link) {
					die('Could not connect: ' . mysql_error());	
				}
			
				mysql_select_db('test', $link) or die('Could not select database.');	
				$sql="Select user_id from users where '$_GET[name]'=name and '$_GET[pwd]'=password and '$_GET[email]'=email;";

				$res=mysql_query($sql , $link);
			
			
				while ($row = mysql_fetch_assoc($res)) 
				{
				echo "Your id:";
				echo $row['user_id'];
			
							
				header( 'Location: http://localhost/wordpress/?page_id=85&user_id='.$row['user_id']); // ID of home page

				}
			}
			}
			$obj = new User();
			$var=$obj->check();
			if ($var==1)
			{
			$obj->add($connect);
			}

		?>