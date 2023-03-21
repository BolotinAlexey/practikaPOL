<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />

    <title>Hotel Reservation System</title>
  </head>
  <body>
    <header>
      <a href="index.php" class="logo">Szalony dom</a>
      <a href="" class="login"><span>Login</span></a>
    </header>

<main class="main__login">
   <form method="post" action="login.php">
  <label for="username">Username:</label>
  <input type="text" id="username" name="login"><br>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password"><br>

  <input type="submit" value="Login">
</form>



<?php
session_start();
echo $_POST["login"];
echo $_POST["password"];
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = $_POST["login"];
  $password = $_POST["password"];

  // Query the database to check if the user exists
  $sql = "SELECT * FROM Employee WHERE login='$login' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  // If the user exists, create a session and redirect to the admin panel
  if (mysqli_num_rows($result) == 1) {
    
    $_SESSION["login"] = $login;
    header("Location: admin.php");
  } else {
    // If the user does not exist, display an error message
    echo "Invalid username or password";
  }
}

mysqli_close($conn);
?>

</main>

    <footer>
  © 2023 Oleksii Bolotin for Cosinus
</footer>
  </body>
</html>
  </body>
</html>
