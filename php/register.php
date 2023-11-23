<?php
require 'vendor/autoload.php';
use Predis\Client;

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();

    $redis = new Client();
    $sessionId = uniqid('session_', true);
    $redis->set($sessionId, $username);
    echo json_encode(['sessionId' => $sessionId]);

    $conn->close();
}
?>