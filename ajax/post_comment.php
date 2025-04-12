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

    $comment = sanitize($_POST['comment']);
    $user_id = $_SESSION['user_id'];
    
    // code...
    $sql = "INSERT INTO comments (user_id, comment) VALUES ('$user_id', '$comment')";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
}
?>