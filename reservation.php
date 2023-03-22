<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>manager reservation</title>
</head>
<body>

 <header>

    <a href="index.php" class="logo">Szalony dom</a>
    <a href="login.php" class="login"><span>Login</span></a>
    </header>
<main class="main__admin">


<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

// Display the admin panel

echo '<div class="greeting"> <h3>Welcome, ' . $_SESSION["login"].'</h3>
<div class="buttons">
<form action="admin.php">
<button type="submit" class="switcher">Check in</button></form>

<form action="liberation.php">
<button type="submit" class="switcher">Liberation</button></form>
</div>
</div>';


// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "hotel";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
			
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// Check if the user has submitted the reservation form
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			// Retrieve the form data

			$name = $_POST["name"];			
			$room = $_POST["room"];
			$phone_number = $_POST["phone_number"];
			$check_in_date = $_POST["check_in_date"];
			$check_out_date = $_POST["check_out_date"];

			// Insert the new guests check in into the database
			$sql = "INSERT INTO Reservation (room,name,phone_number,check_in_date,check_out_date) VALUES ('$room','$name','$phone_number','$check_in_date','$check_out_date')";

			$sql_room="UPDATE Room SET available = FALSE WHERE room_number = ".$room;
		
			// Insert the new guests check in into the database
			if (mysqli_query($conn, $sql)) {      

				// Room.available to FALSE
				if (mysqli_query($conn, $sql_room)) {
					echo "Check in made successfully";
                     header('Location: '.$_SERVER["PHP_SELF"]);
                    exit();
					}else{
				echo "Error: " . $sql_room . "<br>" . mysqli_error($conn);}
							
			}
			 else {
				echo "Error: " . $sql_guest . "<br>" . mysqli_error($conn);
		}

		}

            // ------------ check in by guests ------------

            	// Query the database for available rooms
		$sql = "SELECT * FROM Room WHERE available = TRUE";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

			// Display the list of available rooms and reservation form
			echo "<h2>Available Rooms</h2>";
			echo "<table>";
			echo "<tr><th>Room Number</th><th>Room Type</th><th>Price</th><th>Max occupancy</th><th>Foto</th><th>Guests</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["room_number"] . "</td><td>" . $row["room_type"] . "</td><td>" . $row["room_price"] . "</td><td>" . $row["max_occupancy"] . "</td><td><img src='" . $row["img"] . "'></td>
                <td>";

				echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
                
				echo "<input type='hidden' name='room' value='" . $row["room_number"] . "'>";

				echo "<label for='name'>Name:</label>";
				echo "<input type='text' id='name' name='name'><br>";

				echo "<label for='guest_name'>Phone number:</label>";
				echo "<input type='text' id='phone_number' name='phone_number'><br>";

				echo "<label for='check_in_date'>Check-in Date:</label>";
				echo "<input type='date' id='check_in_date' name='check_in_date'><br>";

				echo "<label for='check_out_date'>Check-out Date:</label>";
				echo "<input type='date' id='check_out_date' name='check_out_date'><br>";

				echo "<input type='submit' value='Reserve'>";
				echo "</form></td></tr>";
			}
			echo "</table>";
		} 
        // --------------------------------------------
        else {
			echo "No rooms available";
		}

		// Close the database connection
		mysqli_close($conn);
?>

</main>
    <footer>
  © 2023 Oleksii Bolotin for Cosinus
</footer>
</body>
</html>