<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$username = $_POST['username'];
$password = $_POST['password'];

// check user from database
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['designation_id'] = $user['designation_id'];
    $_SESSION['username'] = $user['username'];

    header("Location: modules/admin/dashboard.php");
    exit();
} else {
    echo "<div class='alert alert-danger m-3'>Invalid Login!</div>";
}
?>
