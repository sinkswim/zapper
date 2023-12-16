<?php 
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

	include ('connect.php');
	session_start();	

	$score = $_POST['score'];
	
	// TODO issues with $_SESSION[username] -> it's empty
	// $searchUserRecordScore = "SELECT record FROM users WHERE username='$_SESSION[username]'";
	$searchUserRecordScore = "SELECT record FROM users WHERE username='adaba'";

	$checkUserResult = $mysqli_connection->query($searchUserRecordScore);

	$row = $checkUserResult->fetch_assoc();
	
	if ($checkUserResult->num_rows == 1 and $score > $row["record"]) {
			if ($mysqli_connection->query("UPDATE users SET record=$score WHERE username='adaba'") === TRUE) {
				echo 'Congratulations, you\'ve set a new personal record!';
		  	} 
			else { echo "Error updating record: " . $conn->error; }

	}
	else {
		echo 'Too bad, you didn\'t improve your record. Try again!';
	}
?>