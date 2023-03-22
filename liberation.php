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
    <title>manager liberation</title>
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
<form action="admin.php">
<button type="submit" class="switcher">Check in</button></form>

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
			$room_number = $_POST["room_number"];
            $guest_id = $_POST["guest_id"];
            $reservation_id = $_POST["reservation_id"];

            if (empty(!$guest_id )){
			// Delete guests from the database
			$sql_delete = "DELETE FROM Guests WHERE guest_id = ".$guest_id;}
            
            elseif(empty(!$reservation_id )){
            // Delete reservation from the database
			$sql_delete = "DELETE FROM Reservation WHERE reservation_id = ".$reservation_id;}

            else {
                echo "Choose someone to delete";
                     header('Location: '.$_SERVER["PHP_SELF"]);
                    exit();
            }

            // Update Room 
			$sql_room="UPDATE Room SET available = TRUE WHERE room_number = ".$room_number;
		
            // Delete from Reservation or Guests
			if (mysqli_query($conn, $sql_delete)) {

            
				if (mysqli_query($conn, $sql_room)) {
                    echo "Delete in made successfully";
                     header('Location: '.$_SERVER["PHP_SELF"]);
                    exit();
                    
                    } else{
				    echo "Error: " . $sql_room . " " . mysqli_error($conn);}

            	}else{
				echo "Error: " . $sql_delete . " " . mysqli_error($conn);}
				
                }
            // ------------ RESERVATION LIST -------------

	$sqlR = "SELECT * FROM Reservation JOIN Room ON Reservation.room=Room.room_number";
		$result = mysqli_query($conn, $sqlR);

		if (mysqli_num_rows($result) > 0) {

			// Display the list of reservation form
			echo "<h2>Residential rooms</h2>";

			echo "<table>";
			echo "<tr><th>Room Number</th><th>Price</th><th>Name</th><th>Check in</th><th>Check out</th><th>Delete from</br>reservation</th></tr>";

			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["room"] . "</td><td>" . $row["room_price"] . "</td><td>" . $row["name"] . "</td><td>" . $row["check_in_date"]. "</td><td>" .$row["check_out_date"]. "</td>";

                
                // ---------- inputs of reservation ------------

				echo "<td><form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
                
				echo "<input type='hidden' name='room_number' value='" . $row["room_number"] . "'>";

                echo "<input type='hidden' name='reservation_id' value='" . $row["reservation_id"] . "'>";

				echo "<button class='delete' type='submit'>DELETE</button></form></td></tr>";
			}
			echo "</table>";
		} 


        // ------------ GUESTS LIST -------------
        
		$sql = "SELECT * FROM Guests JOIN Room ON Guests.room = Room.room_number";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

			// Display the list of available rooms and reservation form
			echo "<h2>Guests rooms</h2>";
			echo "<table>";
				echo "<tr><th>Room Number</th><th>Price</th><th>Name</th><th>Check in</th><th>Check out</th><th>Delete from</br>guests</th></tr>";

			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["room"] . "</td><td>" . $row["room_price"] . "</td><td>" . $row["guest_name"] . "</td><td>" . $row["check_in_date"]. "</td><td>" .$row["check_out_date"]. "</td>";

                
                // ---------- inputs of guests ------------

				echo "<td><form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
                
				echo "<input type='hidden' name='room_number' value='" . $row["room_number"] . "'>";

                echo "<input type='hidden' name='guest_id' value='" . $row["guest_id"] . "'>";

				echo "<button class='delete' type='submit'>DELETE</button></form></td></tr>";
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