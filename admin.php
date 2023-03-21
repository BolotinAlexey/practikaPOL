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
    <title>manager panel</title>
</head>
<body>

 <header>

    <a href="index.php" class="logo">Szalony dom</a>
    <a href="" class="login"><span>Login</span></a>
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
<button type="submit" class="switcher">Occupated</button>
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
			$guest_name = $_POST["guest_name"];
			
			$guest_email = $_POST["guest_email"];
			$room_number = $_POST["room_number"];
			$phone_number = $_POST["phone_number"];
			$adress = $_POST["address"];
			$check_in_date = $_POST["check_in_date"];
			$check_out_date = $_POST["check_out_date"];

			// Insert the new reservation into the database
			$sql_guest = "INSERT INTO Guests (guest_name,guest_email,phone_number,address) VALUES ('$guest_name','$guest_email','$phone_number','$adress')";

			$sql_room="UPDATE Room SET available = FALSE WHERE room_number = ".$room_number;
		
			
			if (mysqli_query($conn, $sql_guest)) {
				$last_id = $conn->insert_id;
				$sql_reserv="INSERT INTO Reservation (guest_id,room_number,check_in_date,check_out_date) VALUES ('$last_id','$room_number','$check_in_date','$check_out_date')";

				if (mysqli_query($conn, $sql_reserv)) {

					if (mysqli_query($conn, $sql_room)) {
							echo "Reservation made successfully";
					}else{
				echo "Error: " . $sql_room . "<br>" . mysqli_error($conn);}
					
				} else{
				echo "Error: " . $sql_reserv . "<br>" . mysqli_error($conn);}				
			}
			 else {
				echo "Error: " . $sql_guest . "<br>" . mysqli_error($conn);
		}

		}

		


		// Query the database for available rooms
		$sql = "SELECT * FROM Room WHERE available = TRUE";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// Display the list of available rooms and reservation form
			echo "<h1>Available Rooms</h1>";
			echo "<table>";
			echo "<tr><th>Room Number</th><th>Room Type</th><th>Price</th><th>Reserve</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["room_number"] . "</td><td>" . $row["room_type"] . "</td><td>" . $row["room_price"] . "</td><td>";
				echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
				echo "<input type='hidden' name='room_number' value='" . $row["room_number"] . "'>";
				echo "<label for='guest_name'>Name:</label>";
				echo "<input type='text' id='guest_name' name='guest_name'><br>";
				echo "<label for='guest_email'>Email:</label>";
				echo "<input type='email' id='guest_email' name='guest_email'><br>";

echo "<label for='guest_name'>Phone number:</label>";
				echo "<input type='text' id='phone_number' name='phone_number'><br>";

				echo "<label for='address'>Address:</label>";
				echo "<input type='text' id='address' name='address'><br>";


				
				echo "<label for='check_in_date'>Check-in Date:</label>";
				echo "<input type='date' id='check_in_date' name='check_in_date'><br>";
				echo "<label for='check_out_date'>Check-out Date:</label>";
				echo "<input type='date' id='check_out_date' name='check_out_date'><br>";
				echo "<input type='submit' value='Reserve'>";
				echo "</form></td></tr>";
			}
			echo "</table>";
		} else {
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