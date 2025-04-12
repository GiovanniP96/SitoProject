<?php
// session_start();
if (!isset($_SESSION['user_id'])) {
    // header('Location: login.php');
    echo "<script>
     window.location.href = 'login.php';
    </script>";
    exit;
}
?>