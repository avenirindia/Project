<?php
session_start();
include('config/db.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash the password before checking

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
        $error = "Invalid username or password!";
    }
}
?>
