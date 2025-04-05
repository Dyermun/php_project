<?php
header('Content-Type: application/json');
require 'db_config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['id']) || empty($data['name']) || empty($data['comment']) || !isset($data['rating'])) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

try {
    $stmt = $conn->prepare("UPDATE ratings SET name = :name, rating = :rating, comment = :comment WHERE id = :id");
    $stmt->bindParam(':id', $data['id']);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':rating', $data['rating']);
    $stmt->bindParam(':comment', $data['comment']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
