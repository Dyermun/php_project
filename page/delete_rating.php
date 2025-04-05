<?php
header('Content-Type: application/json');
require 'db_config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['id'])) {
    echo json_encode(['success' => false, 'message' => 'Rating ID is required']);
    exit;
}

try {
    $stmt = $conn->prepare("DELETE FROM ratings WHERE id = :id");
    $stmt->bindParam(':id', $data['id']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
