<?php
extension_loaded('mongodb') or die('The MongoDB extension is not loaded.');
require 'vendor/autoload.php';
use Predis\Client;

$sessionId = $_POST['sessionId'];
$redis = new Client();
$username = $redis->get($sessionId);

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->user_authentication_mongodb;
$collection = $db->users;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedDetails = [
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'dob' => $_POST['dob'],
        'contact' => $_POST['contact'],
        'fatherName' => $_POST['fatherName'],
        'motherName' => $_POST['motherName'],
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'country' => $_POST['country'],
        'currentPosition' => $_POST['currentPosition'],
    ];

    $updateResult = $collection->updateOne(
        ['username' => $username],
        ['$set' => $updatedDetails]
    );

    if ($updateResult->getModifiedCount() > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user details.']);
    }
}

$redis->set($sessionId, $username);

$mongoClient->close();
?>