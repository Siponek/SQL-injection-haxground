<?php

require_once 'libs/redirectFunctions.php';



//? You should use environment variables to store database credentials
// $dbhost = getenv('DB_HOST');
// $dbuser = getenv('DB_USER');
// $dbpass = getenv('DB_PASS');
// $dbname = getenv('DB_NAME');

// $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Connect to DB
$conn = new mysqli('db', 'root', '123' /* FIXME hide this? */, 'fstt23');
//? Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$user = $_POST['user'];
$pass = $_POST['pass'];


//? Create a prepared statement
// $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
// $stmt->bind_param("s", $user);

//? Execute the statement
// $stmt->execute();

//? Get the result
// $result = $stmt->get_result();


try {
    // execute query
    $results = $conn->query("SELECT * FROM users WHERE username = '$user' AND password = '$pass'");
    // a' OR 'b'='b
// check if any rows were returned
// FIXME number of rows should be 1, not more
    // if ($results === false) {
    //     throw new Exception($conn->error);
    // } else
    if ($results->num_rows > 0) {
        // Display welcome message if login was successful
        $row = $results->fetch_assoc();
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        redirectToLogin("Login successful! Welcome $first_name $last_name!");
    } else {
        // Otherwise, generic error message
        redirectToLogin("Login failed! Redirecting...");
    }
} catch (Exception $errno) {
    //throw $th;
    echo "Error: " . $errno->getMessage();
    redirectToLogin("Got error, redirecting...");
}

// close connection
$conn->close();