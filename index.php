<!DOCTYPE html>
<html>
  <head>
    <title>Hotel Reservation System</title>
  </head>
  <body>
    <h1>hotel</h1>
    <?php
		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "baza";

		$conn = mysqli_connect($servername, $username, $password, $dbname);
echo "<h2>khkh</h2>";
		if (!$conn) {
      
			die("Connection failed: " . mysqli_connect_error());
		}

		// Query the database for available rooms
		$sql = "SELECT * FROM Room WHERE is_available = 1";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) >
    0) {
       // Display the list of available rooms
        echo "<h2>Available Rooms</h2>";
         echo "<table>";
          echo "<tr>
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Price</th>
      </tr>";
       while ($row = mysqli_fetch_assoc($result)) {
         echo "
      <tr>
        <td>" . $row["room_number"] . "</td>
        <td>" . $row["room_type"] . "</td>
        <td>" . $row["price"] . "</td>
      </tr>
      "; }
       echo "</table>";
       } else { 
        echo "No rooms available"; 
      } 
    mysqli_close($conn);
     ?>
  </body>
</html>