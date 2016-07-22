<?php 
	
	//  This php file is just for the developer. We can comment out all the functions that are being called in 
	//	the Form.php file before giving to the customer. This is only for if all the steps are properly working or not.

	function usnandusp($username,$email, $cellno, $passcode) {
		return "Entered name is : {$username} <br /> having email : {$email} <br /> 
		and cell number : {$cellno} <br /> with password : {$passcode} <br />";
	}
	//..........................................Database connection.................................
	function connectingerrorornot($connection) {

		if (!$connection) {
			
			die("Connection failed : " . mysqli_connect_error() . " ( " . mysqli_connect_errno() . " ) " . "<br />");
		}else {

			//echo "Database connected successfully...! <br />";
		}
	}
	//..........................................Database creation...................................
	function okcreatedb() {

		echo "Database created successfully...! <br />";
	}
	function errorcreatedb() {

		die("Here is a problem in creating database" . mysqli_connect_error() . " ( " . mysqli_connect_errno() . " ) " . "<br />");
	}
	function dbalreadyexist() {

		echo "Database already exists...! <br />";
	}
	//.........................................Table creation.......................................
	function okcreatetable() {

		echo "Table is created successfully...! <br />";
	}
	function errorcreatetable() {

		die("Here is a problem in creating table" . mysqli_connect_error() . " ( " . mysqli_connect_errno() . " ) " . "<br />") ;
	}
	function tablealreadyexists() {

		echo "Table already exists...! <br />";
	}

?>