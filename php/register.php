<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
   <title> Output Registrazione a Zapper </title>

<?php
   include 'header.php';
   include ("connect.php");
   if(mysql_num_rows(mysql_query("SELECT * from users WHERE username='" . $_POST['username'] . "'")) == 1){
      echo "<p>Username gia' in uso, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if($_POST['password'] != $_POST['repassword']){
      echo "<p>Le due password non coincidono, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(strlen($_POST['username']) > 12){
      echo "<p>Username troppo lungo, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(strlen($_POST['username']) < 5){
      echo "<p>Username troppo corto, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(strlen($_POST['password']) > 12){
      echo "<p>Password troppo lunga, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(strlen($_POST['password']) < 5){
      echo "<p>Password troppo corta, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(preg_match('/[^0-9A-Za-z]/',$_POST['username'])){
      echo "<p>Usa solo lettere o numeri per lo username, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(preg_match('/[^0-9A-Za-z]/',$_POST['password'])){
      echo "<p>Usa solo lettere o numeri per la password, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else{
      mysql_query("INSERT into users VALUES ('".$_POST['username']."', '".$_POST['password']."', '".'0'."')") or die(mysql_error());
      header('Location: ../index.php'); //reindirizzamento alla home page
      }
?>

</body>
</html>

