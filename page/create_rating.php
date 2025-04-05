<?php
header('Content-Type: application/json');
require 'db_config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['name']) || empty($data['comment']) || !isset($data['rating'])) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO ratings (name, rating, comment) VALUES (:name, :rating, :comment)");
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':rating', $data['rating']);
    $stmt->bindParam(':comment', $data['comment']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
