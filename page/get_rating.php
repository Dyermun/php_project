<?php
header('Content-Type: application/json');
require 'db_config.php';

$id = $_GET['id'] ?? 0;

try {
    $stmt = $conn->prepare("SELECT * FROM ratings WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $rating = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($rating) {
        echo json_encode($rating);
    } else {
        echo json_encode(['error' => 'Rating not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
