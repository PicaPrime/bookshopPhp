<!-- this page is after the customer log in  -->
<!DOCTYPE html>
<html>
<head>
	<title>Buy or Rent Books</title>
</head>
<body>
	<h1>Buy or Rent Books</h1>
	<form method="post" action="process_purchase.php">
		<label for="book_id">Book ID:</label>
		<input type="text" id="book_id" name="book_id" required><br><br>

		<label for="transaction_type">Transaction Type:</label>
		<select id="transaction_type" name="transaction_type" required>
			<option value="buy">Buy</option>
			<option value="rent">Rent</option>
		</select><br><br>

		<label for="transaction_duration">Transaction Duration (in days):</label>
		<input type="number" id="transaction_duration" name="transaction_duration" required><br><br>

		<label for="user_id">User ID:</label>
		<input type="text" id="user_id" name="user_id" required><br><br>

		<input type="submit" value="Submit">
	</form>
</body>
</html>
