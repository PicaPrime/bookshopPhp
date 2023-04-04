<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$book_id = $_POST["book_id"];
$transaction_type = $_POST["transaction_type"];
$transaction_duration = $_POST["transaction_duration"];
$user_id = $_POST["user_id"];

// Check if book exists and is available for transaction type
$sql = "SELECT * FROM books WHERE id = '$book_id' AND available_for_$transaction_type = 1";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Book not found or not available for $transaction_type";
} else {
    // Calculate transaction cost
    $book = $result->fetch_assoc();
    if ($transaction_type == "buy") {
        $transaction_cost = $book["price"];
    } else {
        $transaction_cost = $book["rent_price"] * $transaction_duration;
    }

    // Insert transaction into transactions table
    $sql = "INSERT INTO transactions (book_id, transaction_type, transaction_duration, user_id, transaction_cost) 
            VALUES ('$book_id', '$transaction_type', '$transaction_duration', '$user_id', '$transaction_cost')";
    if ($conn->query($sql) === TRUE) {
        echo "Transaction successful. Total cost: $transaction_cost";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Update book availability
    $sql = "UPDATE books SET available_for_$transaction_type = 0 WHERE id = '$book_id'";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
