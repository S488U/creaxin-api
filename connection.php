<?php
$servername = "<HOST>"; // or your specific database host
$dbname = "<DATABASE_NAME>";
$username = "<DATABASE_USERNAME>";
$password = "<DATABASE_PASSWORD>";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: (" . $conn->connect_errno . ") " . $conn->connect_error);
}

echo "Connected successfully"; // Temporary debug message

$conn->close();
?>
