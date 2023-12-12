<?php
	$host = "localhost"; 
	$user = "root"; 
	$password = ""; 
	$db = "zapperdb";

	// Connect to MySQL Server and Zapper DB
	$mysqli_connection = new mysqli($host,$user,$password, $db);

	// Check connection
	if ($mysqli_connection -> connect_error) {
		echo "Failed to connect to MySQL: " . $mysqli_connection -> connect_error;
		exit();
  	}
  
?>