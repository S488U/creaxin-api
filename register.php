<?php
$servername = "localhost";
$dbname = "id22173902_creaxin_data_main";
$username = "id22173902_shah_creaxin";
$password = "creaxin_Shahabas@12";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $api_token = bin2hex(random_bytes(16));

    $stmt = $conn->prepare("INSERT INTO users (username, password, api_token) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $api_token);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User registered successfully", "api_token" => $api_token]);
    } else {
        echo json_encode(["error" => "Registration failed"]);
    }

    $stmt->close();
}

$conn->close();
?>
