<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php session_start(); ?>

<html lang="it">

<head>
	<?php if(!isset($_SESSION['username'])) 
		 		 header('Location: ../index.php');  ?> 

	<title> Play Zapper! </title>
	<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1">
	<meta name="author" content="Robert Margelli">
	<meta name="keywords" content="zapper,gioco,sparatutto,javascript">
	<meta name="description" content="Zapper: un gioco sparatutto basato su Javascript">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/gamecss.css">
	<script type="text/javascript" src='../js/gamelogic.js'></script>
</head>

<body onload="inizializza();">
	<div> <img class="logo" src="../media/zapper_logo.png"alt="Zapper Logo"> </div>
	<div>
	<table class="linkbar">
		<tr> <td valign="top"> <a href="../index.php" > home </a> </td>
			 <td valign="top"> <a href="../html/about.html"> about </a> </td>
		</tr>
	</table>
	</div>

	<div id="gamewindow"></div>

	<div>
		<input type="button" value="Log Out" onClick="window.location='logout.php'">
		<input type="button" value="Check leaderboard" onClick="document.location.href='leaderboard.php'">
	</div>

</body>
</html>