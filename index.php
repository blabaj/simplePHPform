<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" type="text/css" href="Form.css">
</head>
<body>

	<div id="wrapper">
		<form action="index.php" method="POST">
			<input type="text" name="name" id="name" placeholder="Enter your name here" /><br />
			<input type="email" name="email" id="email" placeholder="Enter your email here" /><br />
			<input type="text" name="cellno" id="cellno" placeholder="Enter your cell no. here" /><br />
			<input type="password" name="password" id="password" placeholder="Enter your password here" /><br />
			<input type="submit" name="submit" id="submit" value="Submit" />
		</form>
		<div id="show">	
		<?php 
			require_once('debugg.php');

			//............................Checking whether user input the details........................
			if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['cellno']) && isset($_POST['password'])) {

				$username = $_POST['name'];
				$email = $_POST['email'];
				$cellno = $_POST['cellno'];
				$passcode = $_POST['password'];
				
				echo usnandusp($username,$email, $cellno, $passcode);				// This line is for debugging (just for developer)
			//................................Making the database connection...............................
				
				$dbhost = "localhost";
				$dbusname = "root";
				$dbpass = "";
				$dbname = "userinfo";
				$dbtable = "info";
				$connection = mysqli_connect($dbhost, $dbusname, $dbpass);

				connectingerrorornot($connection);								//	In debugging mode
				
			//..............................Creating database once if does not exist......................
				
				if(!mysqli_select_db($connection, $dbname)) {
		    		
		    		$createdb = "CREATE DATABASE IF NOT EXISTS $dbname";		//  Making database query
		    		if(mysqli_query($connection, $createdb)) {
						//okcreatedb();											//	Database is created successfully
					}else{
						//errorcreatedb();										//  Some error occur during creating database
					}
				}else{
		    		//dbalreadyexist();											//	Database already exists
				}

			//..............................Creating table once if does not exists.........................

				$showtable = "SHOW TABLES LIKE '$dbtable'";
				$tablequery = mysqli_query($connection, $showtable);
				$count = mysqli_num_rows($tablequery);
				if($count < 1) {
					
					$createtable = "CREATE TABLE info(id INT(11) NOT NULL AUTO_INCREMENT, name VARCHAR(50) NOT NULL, email VARCHAR(30) NOT NULL, cellno VARCHAR(20) NOT NULL, password VARCHAR(30) NOT NULL, PRIMARY KEY(id))";
					if(mysqli_query($connection, $createtable)) {
						//okcreatetable();										//  Table created successfully
					}else {
						//errorcreatetable();										//  Some error occur during creating table
					}
				}else {
					//tablealreadyexists();										//  Table already exists
				}
				

			//...........................Inserting data in the database...................................

				$datainserting = "INSERT INTO info(";
				$datainserting .= " name, email, cellno, password";
				$datainserting .= ") VALUES (";
				$datainserting .= " '{$username}', '{$email}', '{$cellno}', '{$passcode}'";
				$datainserting .= ")";

				$datainsertingresult = mysqli_query($connection, $datainserting);
				if($datainsertingresult) {

					echo "Success...!";
				}else {
					die("Some error occur during inserting data : " . mysqli_error($connection) . " ( " . mysqli_errno($connection) . " ) " . "<br />");
				}

				//mysqli_close($connection);

			}
		 ?>
		</div>
	</div>

</body>
</html>