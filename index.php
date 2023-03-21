
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    <title>Hotel Reservation System</title>
  </head>
  <body>
    <header>

    <a href="index.php" class="logo">Szalony dom</a>
    <a href="login.php" class="login"><span>Login</span></a>
    </header>
    <main>
    <h1>hotel</br>"Szalony dom"</h1>

    <?php
		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "hotel";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

    
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

    if (isset($_POST['available'])) {
        switch ($_POST['available']) {
        case '0':
            $sql = "SELECT * FROM Room";
            $str="All rooms";
            break;
        case '1':
            $sql = "SELECT * FROM Room WHERE available = TRUE";
            $str="Free rooms";
            break;
        case '2':
            $sql = "SELECT * FROM Room WHERE available = FALSE";
          $str="Occupied rooms";
            break;
            default:
            $sql = "SELECT * FROM Room";
            $str="All rooms";
    }
}else{
   $sql = "SELECT * FROM Room";
            $str="All rooms";
}

$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) >
    0) {

   echo " <section class='main'>
<div class='view'>
  <h2>$str</h2>"; 
  if (isset($_POST['view'])) {

     $view=$_POST['view']; }  else $view='true';
     $_SESSION["v"]=$view;

        if ($view=='true') {

  //-------------- T A B L E ---------------

           echo "<h3>Table</h3></div>";
   echo "<table>"; 
          echo "<tr>
        <th>Room number</th>
        <th>Room type</th>
        <th>Maximun</br>occupancy</th>
        <th>Price</th>
        <th>Available</th>
      </tr>";
       while ($row = mysqli_fetch_assoc($result)) {
        $a = $row["available"] ? 'YES' : 'NO';
         echo "
      <tr>
        <td>" . $row["room_number"] . "</td>
        <td>" . $row["room_type"] . "</td>
        <td>" . $row["max_occupancy"] . "</td>
        <td>" . $row["room_price"] . " pl</td>
        <td>" . $a . "</td>
      </tr> ";
     }
       echo "</table>";
    }else{

  // --------------- F O T O -------------------

echo "<h3>Foto</h3> </div>";

 echo "<ul class='card-set'>";
while ($row = mysqli_fetch_assoc($result)) {
         echo "
      <li class='card'>

      
      <img src= '" . $row["img"] . "' alt='". $row['room_number'] . "' class='img'>
       <ul class='describe-foto'>
        <li class=describe-foto__item>" . $row["room_number"] . "</li>
        <li class=describe-foto__item>" . $row["room_type"] . "</li>
        <li class=describe-foto__item>" . $row["room_price"] . " pl</li>
        </ul>
      </li> ";
     }
     echo '</ul>';
    }
 // --------------------------------------------
      
}
    mysqli_close($conn);
     ?>

           <form class="index__form" method="POST">
        <div class="avilable">
 <button name="available" type="submit" value="0">all rooms</button>
 <button name="available" type="submit" value="1">free rooms</button>
 <button name="available" type="submit" value="2">occupied rooms</button>
</div>
 <div class="view">
  <label> table  
    <?php

    session_start();
  $v=$_SESSION["v"];
  
    if ($_SESSION["v"]==='true'){
echo '<input type="radio" name="view" value="true" checked>
  <input type="radio" name="view" value="false">';
    }else{
      echo '<input type="radio" name="view" value="true">
  <input type="radio" name="view" value="false" checked>';
    }
  ?>
  </label>foto
 </div>
</form>
</section>
</main>
<footer>
  © 2023 Oleksii Bolotin for Cosinus
</footer>
  </body>
</html>
