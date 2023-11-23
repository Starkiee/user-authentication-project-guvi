<?php
include('db.php');
require 'vendor/autoload.php';
use Predis\Client;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $dbUsername, $dbPassword);
    $stmt->fetch();

    if (password_verify($password, $dbPassword)) {
        $redis = new Client();
        $sessionId = uniqid('session_', true);
        $redis->set($sessionId, $username);
        echo json_encode(['status' => 'success', 'sessionId' => $sessionId]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid login credentials.']);
    }

    $stmt->close();
    $conn->close();
}
?>