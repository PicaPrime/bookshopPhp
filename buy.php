<?php
	// Connect to database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookshop";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Get book information
	$book_id = $_POST["book_id"];
	$quantity = $_POST["quantity"];
	$sql = "SELECT title, price FROM books WHERE book_id=$book_id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$title = $row["title"];
	$price = $row["price"];

	// Calculate total cost
	$total_cost = $price * $quantity;

	// Display confirmation message
	echo "<p>You have purchased $quantity copy/copies of '$title' for a total cost of $$total_cost.</p>";

	// Close database connection
	mysqli_close($conn);
?>
