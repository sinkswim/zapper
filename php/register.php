<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
   <title> Output Registrazione a Zapper </title>

<?php
   include 'header.php';
   include ('connect.php');

   $searchUserQuery = "SELECT * from users WHERE username='" . $_POST['username'] . "'";
   $checkUserResult = $mysqli_connection->query($searchUserQuery);

   if ($checkUserResult->num_rows == 1) { // User already exists
      while($row = $checkUserResult->fetch_assoc()) {
         echo "<p>Username gia' in uso, <a href='registrazione.php'>riprova</a>!</p>";
      }
   }  
   else if($_POST['password'] != $_POST['repassword']){  // Passwords not matching
      echo "<p>Le due password non coincidono, <a href='registrazione.php'>riprova</a>!</p>";
      } 
   else if(strlen($_POST['username']) > 12){ // Username too long
      echo "<p>Username troppo lungo, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(strlen($_POST['username']) < 5){  // Username too short
      echo "<p>Username troppo corto, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(strlen($_POST['password']) > 12){ // Password too long
      echo "<p>Password troppo lunga, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(strlen($_POST['password']) < 5){ // Password too short
      echo "<p>Password troppo corta, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(preg_match('/[^0-9A-Za-z]/',$_POST['username'])){   // Only characters or numbers for username
      echo "<p>Usa solo lettere o numeri per lo username, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else if(preg_match('/[^0-9A-Za-z]/',$_POST['password'])){ // Only characters or numbers for password
      echo "<p>Usa solo lettere o numeri per la password, <a href='registrazione.php'>riprova</a>!</p>";
      }
   else{ // All checks passed, create user in db table
      echo ('Creating user...');
      $insertUserQuery = "INSERT into users VALUES ('".$_POST['username']."', '".$_POST['password']."', '".'0'."')";
      if ($mysqli_connection->query($insertUserQuery) === TRUE) {
         echo "New user created successfully";
       } else {
         echo "Error creating user: " . $insertUserQuery . "<br>" . $mysqli_connection->error;
       }
      header('Location: ../index.php'); // Go back to home page
      }

      $mysqli_connection->close();
?>

</body>
</html>

