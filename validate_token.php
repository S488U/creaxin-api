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

function validateToken($token) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE api_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Example usage
$token = $_GET['api_token'];
if (validateToken($token)) {
    echo json_encode(["message" => "Valid token"]);
} else {
    echo json_encode(["error" => "Invalid token"]);
}

$conn->close();
?>
