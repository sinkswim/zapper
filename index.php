<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<title> Zapper! </title>
<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1">
<meta name="author" content="sinkswim">
<meta name="keywords" content="zapper,gioco,sparatutto,javascript">
<meta name="description" content="Zapper: un gioco sparatutto basato su Javascript">
<link rel="stylesheet" type="text/css" href="./css/mainstyle.css">
<link rel="stylesheet" type="text/css" href="./css/indexstyle.css">
</head>

<body>
		 <div><a href="./index.php"><img  class="logo" src="./media/zapper_logo.png" alt="Zapper Logo" ></a></div>
		 		<table class="linkbar">
					<tr> <td> <a href="./index.php" > home </a>
					</td>
					<td> <a href="./html/about.html"> about </a> </td>
					</tr>
				</table>

		<p>
			Save your planet from the alien invasion! Login or register now:
		</p>


    <!-- Your HTML code here -->
    <form action="./php/login.php" method="post">
        <div class=login>
        <h3>Log in</h3>
        <div>Username: <input type="text" name="username"></div>
        <div>Password: <input type="password" name="password"></div>
        <input type="submit" value="Log in">
        </div>  
    </form>
    <div class=register> 
        <h4>Click the button below to register your account </h4>
        <input type="button" onClick="location.href='./php/registrazione.php'" value='Sign up'>
    </div>




	
</body>
</html>