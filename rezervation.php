<!DOCTYPE html>
<html>
<head>
	<title>Hotel Reservation System</title>
</head>
<body>
	<?php
		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "hotel_db";

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
			$check_in_date = $_POST["check_in_date"];
			$check_out_date = $_POST["check_out_date"];

			// Insert the new reservation into the database
			$sql = "INSERT INTO Reservation (guest_name, guest_email, room_number, check_in_date, check_out_date) VALUES ('$guest_name', '$guest_email', '$room_number', '$check_in_date', '$check_out_date')";

			if (mysqli_query($conn, $sql)) {
				echo "Reservation made successfully";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		// Query the database for available rooms
		$sql = "SELECT * FROM Room WHERE is_available = 1";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// Display the list of available rooms and reservation form
			echo "<h1>Available Rooms</h1>";
			echo "<table>";
			echo "<tr><th>Room Number</th><th>Room Type</th><th>Price</th><th>Reserve</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["room_number"] . "</td><td>" . $row["room_type"] . "</td><td>" . $row["price"] . "</td><td>";
				echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
				echo "<input type='hidden' name='room_number' value='" . $row["room_number"] . "'>";
				echo "<label for='guest_name'>Name:</label>";
				echo "<input type='text' id='guest_name' name='guest_name'><br>";
				echo "<label for='guest_email'>Email:</label>";
				echo "<input type='email' id='guest_email' name='guest_email'><br>";
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
</body>
</html>

+++++++
kogda gosti uezgajut Sure, here's an example PHP script to update the database when a guest leaves:

<!DOCTYPE html>
<html>
<head>
	<title>Check Out</title>
</head>
<body>
	<?php
		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "hotel_db";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Check if the user has submitted the check-out form
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Retrieve the form data
			$room_number = $_POST["room_number"];
			$check_out_date = $_POST["check_out_date"];

			// Update the room and reservation status in the database
			$sql = "UPDATE Room SET is_available = 1 WHERE room_number = '$room_number'";
			mysqli_query($conn, $sql);

			$sql = "UPDATE Reservation SET check_out_date = '$check_out_date' WHERE room_number = '$room_number' AND check_out_date IS NULL";
			mysqli_query($conn, $sql);

			echo "Check-out completed successfully";
		}

		// Query the database for active reservations
		$sql = "SELECT Reservation.reservation_id, Guest.guest_name, Room.room_number, Reservation.check_in_date FROM Reservation INNER JOIN Guest ON Reservation.guest_id = Guest.guest_id INNER JOIN Room ON Reservation.room_number = Room.room_number WHERE Reservation.check_out_date IS NULL";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// Display the list of active reservations and check-out form
			echo "<h1>Active Reservations</h1>";
			echo "<table>";
			echo "<tr><th>Reservation ID</th><th>Guest Name</th><th>Room Number</th><th>Check-in Date</th><th>Check-out</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["reservation_id"] . "</td><td>" . $row["guest_name"] . "</td><td>" . $row["room_number"] . "</td><td>" . $row["check_in_date"] . "</td><td>";
				echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
				echo "<input type='hidden' name='room_number' value='" . $row["room_number"] . "'>";
				echo "<label for='check_out_date'>Check-out Date:</label>";
				echo "<input type='date' id='check_out_date' name='check_out_date'>";
				echo "<input type='submit' value='Check Out'>";
				echo "</form></td></tr>";
			}
			echo "</table>";
		} else {
			echo "No active reservations";
		}

		// Close the database connection
		mysqli_close($conn);
	?>
</body>
</html>