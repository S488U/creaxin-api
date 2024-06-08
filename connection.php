<?php
$servername = "localhost"; // or your specific database host
$dbname = "id22173902_creaxin_data_main";
$username = "id22173902_shah_creaxin";
$password = "creaxin_Shahabas@12";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: (" . $conn->connect_errno . ") " . $conn->connect_error);
}

echo "Connected successfully"; // Temporary debug message

$conn->close();
?>
