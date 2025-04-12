<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $score = (int)$_POST['score'];
    $total = (int)$_POST['total'];
    $results = json_decode($_POST['results'], true);

    // Prepare email
    $to = "giovanni.pipitone96@gmail.com";
    $subject = "Quiz Results for $username";
    
    $message = "<h2>Quiz Results</h2>";
    $message .= "<p><strong>User:</strong> $username</p>";
    $message .= "<p><strong>Score:</strong> $score/$total</p>";
    
    $message .= "<table border='1' cellpadding='8' style='border-collapse: collapse;'>";
    $message .= "<tr>
        <th style='padding: 8px;'>Question</th>
        <th style='padding: 8px;'>Selected</th>
        <th style='padding: 8px;'>Correct</th>
        <th style='padding: 8px;'>Status</th>
    </tr>";
    
    foreach ($results as $result) {
        $status = $result['isCorrect'] ? '✅ Correct' : '❌ Incorrect';
        $message .= "<tr>
            <td style='padding: 8px;'>{$result['question']}</td>
            <td style='padding: 8px;'>{$result['selected']}</td>
            <td style='padding: 8px;'>{$result['correct']}</td>
            <td style='padding: 8px;'>$status</td>
        </tr>";
    }
    
    $message .= "</table>";

    // Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: giovanni.pipitone96@gmail.com\r\n";

    // Send email
    mail($to, $subject, $message, $headers);

    // Return response
    echo json_encode(['status' => 'success']);
}
?>