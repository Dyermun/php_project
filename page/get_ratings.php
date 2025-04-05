<?php
require 'db_config.php';

try {
    $stmt = $conn->query("SELECT * FROM ratings ORDER BY created_at DESC");
    $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($ratings) > 0) {
        foreach ($ratings as $rating) {
            echo "<div class='rating-item'>";
            echo "<div class='rating-item-header'>";
            echo "<span class='rating-item-name'>{$rating['name']}</span>";
            echo "<span class='rating-item-stars'>" . str_repeat('★', $rating['rating']) . "</span>";
            echo "</div>";
            echo "<p class='rating-item-comment'>{$rating['comment']}</p>";
            echo "<div class='rating-item-footer'>";
            echo "<span class='rating-item-date'>" . date('M j, Y g:i a', strtotime($rating['created_at'])) . "</span>";
            echo "<div class='rating-item-actions'>";
            echo "<button class='btn btn-edit' data-id='{$rating['id']}'>Edit</button>";
            echo "<button class='btn btn-delete' data-id='{$rating['id']}'>Delete</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No ratings yet. Be the first to add one!</p>";
    }
} catch (PDOException $e) {
    echo "<p>Error loading ratings: " . $e->getMessage() . "</p>";
}
