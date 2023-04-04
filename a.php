<!DOCTYPE html>
<html>
<head>
	<title>Bookshop</title>
</head>
<body>
	<h1>Welcome to our bookshop</h1>
	
	<form action="buy.php" method="post">
		<label for="book_id">Select a book:</label>
		<select name="book_id" id="book_id">
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

				// Get list of books
				$sql = "SELECT book_id, title, price FROM books";
				$result = mysqli_query($conn, $sql);

				// Display list of books in dropdown
				while($row = mysqli_fetch_assoc($result)) {
					echo '<option value="' . $row["book_id"] . '">' . $row["title"] . ' - $' . $row["price"] . '</option>';
				}

				// Close database connection
				mysqli_close($conn);
			?>
		</select>
		<br>
		<label for="quantity">Quantity:</label>
		<input type="number" name="quantity" id="quantity" min="1" value="1">
		<br>
		<input type="submit" value="Buy">
	</form>
</body>
</html>
