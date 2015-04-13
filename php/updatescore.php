<?php 
	include 'connect.php';
	session_start();

	$score = $_POST['score'];
	$query = "SELECT record FROM users WHERE username='$_SESSION[username]'";
	$result = mysql_query($query);
	$ret = mysql_fetch_array($result);
	if($score > $ret[0]){
		echo 'Complimenti hai superato il tuo record!';
		mysql_query("UPDATE users SET record=$score WHERE username='$_SESSION[username]'") or die(mysql_error());
		}
	else{
		echo 'Peccato, non hai superato il tuo record.. ritenta!';
		}
?>