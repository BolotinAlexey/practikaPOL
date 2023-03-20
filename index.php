<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <title>Hotel Reservation System</title>
  </head>
  <body>
    <h1>hotel</h1>



    
 

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
}

$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) >
    0) {

        echo "<h2>$str</h2>";
        echo "<h3>Table</h3>";
//  if (isset($_POST['view'])) {

  $view=$_POST['view'];
$_SESSION["v"]=$view;
// echo $_SESSION["v"];

  // echo "<script>localStorage.setItem('view', '$view');</script>";

        if ($view=='true') {
           echo "<h3>Table</h3>";
   echo "<table>"; 
          echo "<tr>
        <th>Room number</th>
        <th>Room type</th>
        <th>Price</th>
      </tr>";
       while ($row = mysqli_fetch_assoc($result)) {
         echo "
      <tr>
        <td>" . $row["room_number"] . "</td>
        <td>" . $row["room_type"] . "</td>
        <td>" . $row["room_price"] . "</td>
      </tr> ";
     }
       echo "</table>";
    }else{
echo "<h3>Foto</h3>";
 echo "<ul class='card-set'>";
while ($row = mysqli_fetch_assoc($result)) {
         echo "
      <li class='card'>

      <div class='thumb'>
      <img src= '" . $row["img"] . "' alt='". $row['room_number'] . "' class='img'>
       
        <p>" . $row["room_number"] . "</p>
        <p>" . $row["room_type"] . "</p>
        <p>" . $row["room_price"] . "</p>
        </div>
      </li> ";
     }
    }


        
}




    mysqli_close($conn);
     ?>

           <form method="POST">
        <div class="avilable">
 <button name="available" type="submit" value="0">all rooms</button>
 <button name="available" type="submit" value="1">free rooms</button>
 <button name="available" type="submit" value="2">occupied rooms</button>
</div>
 <div class="view">
  <label> list  
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
  </body>
</html>
