<?php
include '../includes/config.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    // Add validation checks here
    if (empty(trim($_POST['comment']))) {
        echo json_encode(['status' => 'error', 'message' => 'Comment cannot be empty']);
        exit;
    }

    // Check if user exists
    $user_id = $_SESSION['user_id'];
    $user_check = $conn->query("SELECT id FROM users WHERE id = $user_id");
    if ($user_check->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid user']);
        exit;
    }

    $comment = $conn->real_escape_string($_POST['comment']);
    $parent_id = (int)$_POST['parent_id'];
    $user_id = $_SESSION['user_id'];
    
    // Rest of your existing code...
    // Validate parent comment exists
    $check = $conn->query("SELECT id FROM comments WHERE id = $parent_id");
    if ($check->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Parent comment not found']);
        exit;
    }

    $sql = "INSERT INTO comments (user_id, comment, parent_id) VALUES ('$user_id', '$comment', '$parent_id')";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'comment_id' => $conn->insert_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
}
?>