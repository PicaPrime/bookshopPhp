<?php
// Start the session
session_start();

// Check if the user is already logged in, redirect to home page if true
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: pageForCustomers.php');
    exit;
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // TODO: Validate the form data

    // Connect to the database
    $servername = 'localhost';
    $username_db = 'root';
    $password_db = '';
    $dbname = 'bookshop';
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to check the username and password
    $stmt = $conn->prepare('SELECT user_id, username, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the username exists in the database
    if ($stmt->num_rows > 0) {
        // Bind the results to variables
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start the session
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;

            // Redirect to the home page
            header('Location: home.php');
            exit;
        } else {
            // Password is incorrect
            echo 'Invalid username or password.';
        }
    } else {
        // Username is not found in the database
        echo 'Invalid username or password.';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
