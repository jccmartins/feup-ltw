<?php
include_once '../includes/database.php';

// Current time
$timestamp = time();

// Get last_id
$last_id = $_GET['last_id'];
$place_id = $_GET['place_id'];

// Database connection
$db = Database::instance()->db();

if (isset($_GET['username']) && isset($_GET['text'])) {
  // GET username and text
  $username = $_GET['username'];
  $text = $_GET['text'];
  // Insert Message
  $stmt = $db->prepare("INSERT INTO chat VALUES (null, ?, ?, ?, ?)");
  $stmt->execute(array($timestamp, $username, $text, $place_id));
}

// Retrieve new messages
$stmt = $db->prepare("SELECT * FROM chat WHERE id > ? AND place_id = ? ORDER BY date DESC LIMIT 10");
$stmt->execute(array($last_id, $place_id));
$messages = $stmt->fetchAll();

// In order to get the most recent messages we have to reverse twice
$messages = array_reverse($messages);

// Add a time field to each message
foreach ($messages as $index => $message) {
  $time = date('d M Y', $message['date']);
  $messages[$index]['time'] = $time;
}

// JSON encode
echo json_encode($messages);
