<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "bookshop");

// Check for errors
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get user input
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

if (mysqli_query($conn, $sql)) {
	echo "User registered successfully.";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?> 