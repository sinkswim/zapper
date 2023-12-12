<?php 
	include 'connect.php';
	session_start();

	echo "<script type='text/javascript'>alert('in updatescore.php');</script>";

	$score = $_POST['score'];
	$query = "SELECT record FROM users WHERE username='$_SESSION[username]'";
	$result = $mysqli_connection->query($query);
	$ret = mysql_fetch_array($result);

	echo $row[0];

	if($score > $row[0]){
		echo 'Complimenti hai superato il tuo record!';
		$mysqli_connection->query("UPDATE users SET record=$score WHERE username='$_SESSION[username]'");
		}
	else{
		echo 'Peccato, non hai superato il tuo record.. ritenta!';
	}
?>