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
    <title>manager guests</title>
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
<div class="buttons">
<form action="liberation.php">
<button type="submit" class="switcher">Liberation</button></form>

<form action="reservation.php">
<button type="submit" class="switcher">Reservation</button></form>
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
		
		// Check in if the user has submitted the reservation form
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			// Retrieve the form data
			$guest_name = $_POST["guest_name"];
			
			$guest_email = $_POST["guest_email"];
			$room_number = $_POST["room_number"];
			$phone_number = $_POST["phone_number"];
			$adress = $_POST["address"];
			$check_in_date = $_POST["check_in_date"];
			$check_out_date = $_POST["check_out_date"];

			// Insert the new guests check in into the database
			$sql_guest = "INSERT INTO Guests (guest_name,guest_email,phone_number,address,room,check_in_date,check_out_date) VALUES ('$guest_name','$guest_email','$phone_number','$adress','$room_number','$check_in_date','$check_out_date')";

			$sql_room="UPDATE Room SET available = FALSE WHERE room_number = ".$room_number;
		
			echo "DELETE FROM Reservation WHERE reservation_id=".$_POST["reservation_id"];
			if (mysqli_query($conn, $sql_guest)) {
				// $last_id = $conn->insert_id;



                if (!empty($_POST["reservation_id"])) {

				$sql_reserv_delete = "DELETE FROM Reservation WHERE reservation_id = ".$_POST["reservation_id"];
				if (mysqli_query($conn, $sql_reserv_delete)) {
                    echo "Delete from reservation in made successfully";
                } else{
				echo "Error: " . $sql_reserv_delete . "<br>" . mysqli_error($conn);}
            	}
                              


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



            // ------------ check in by guests -------------

	$sqlR = "SELECT * FROM Reservation JOIN Room ON Reservation.room=Room.room_number";
		$result = mysqli_query($conn, $sqlR);

		if (mysqli_num_rows($result) > 0) {

			// Display the list of available rooms and reservation form
			echo "<h2>Residential rooms</h2>";

			echo "<table>";
			echo "<tr><th>Room Number</th><th>Price,pl</th><th>Max occupancy<hr/>Type</th><th>Name<hr/>Phone number</th>  <th>check in date<hr/>check out date</th><th>Reserve</th></tr>";

			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["room"] . "</td><td>" . $row["room_price"] . "</td><td>" . $row["max_occupancy"] . "</br></br><hr/></br>" . $row["room_type"] ."</td><td>" . $row["name"] . "</br></br><hr/></br>". $row["phone_number"] ."</td><td>" . $row["check_in_date"]. "</br></br><hr/></br>" .$row["check_out_date"]. "</td>";

                
                // --------------- inputs ----------------

				echo "<td><form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
                
				echo "<input type='hidden' name='room_number' value='" . $row["room_number"] . "'>";

                echo "<input type='hidden' name='reservation_id' value='" . $row["reservation_id"] . "'>";

				echo "<label for='guest_name'>Name:</label>";
				echo "<input type='text' id='guest_name' name='guest_name' value= '" . $row["name"] . "' ><br>";

				echo "<label for='guest_email'>Email:</label>";
				echo "<input type='email' id='guest_email' name='guest_email'><br>";

                echo "<label for='phone_number'>Phone number:</label>";
				echo "<input type='text' id='phone_number' name='phone_number' value= '" . $row["phone_number"] . "' ><br>";

				echo "<label for='address'>Address:</label>";
				echo "<input type='text' id='address' name='address'><br>";

				echo "<label for='check_in_date'>Check-in Date:</label>";
				echo "<input type='date' id='check_in_date' name='check_in_date' value= '" . $row["check_in_date"] . "' ><br>";

				echo "<label for='check_out_date'>Check-out Date:</label>";
				echo "<input type='date' id='check_out_date' name='check_out_date' value= '" . $row["check_out_date"] . "' ><br>";

				echo "<input type='submit' value='Check in'>";
				echo "</form></td></tr>";
			}
			echo "</table>";
		} 
        // --------------------------------------------

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

				echo "<input type='submit' value='Check in'>";
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