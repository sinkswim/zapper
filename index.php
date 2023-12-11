<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<title> Zapper! </title>
<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1">
<meta name="author" content="Robert Margelli">
<meta name="keywords" content="zapper,gioco,sparatutto,javascript">
<meta name="description" content="Zapper: un gioco sparatutto basato su Javascript">
<link rel="stylesheet" type="text/css" href="./css/mainstyle.css">
<link rel="stylesheet" type="text/css" href="./css/indexstyle.css">
</head>

<body>
		 <div><img  class="logo" src="./media/zapper_logo.png" alt="Zapper Logo" ></div>
		 		<table class="linkbar">
					<tr> <td> <a href="./index.php" > home </a>
					</td>
					<td> <a href="./html/about.html"> about </a> </td>
					</tr>
				</table>

		<p>
			Salva il tuo pianeta dall'invasione aliena! Connettiti subito o registrati (per ulteriori informazioni clicca su "About"):
		</p>
		
		<form action="./php/login.php" method="post">
			<div class=login>
			<h3>Log in</h3>
			<div>Username: <input type="text" name="username"></div>
			<div>Password: <input type="password" name="password"></div>
			<input type="submit" value="Log in!">
			</div>	
		</form>
		<div class=register> 
			<h4>Se non sei registrato clicca nel riquadro sottostante per creare un account! </h4>
			<input type="button" onClick="location.href='./php/registrazione.php'" value='Registrati'>
		</div>
	
</body>
</html>