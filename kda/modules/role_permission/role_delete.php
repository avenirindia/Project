<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM designations WHERE id=$id");
header("Location: role_list.php");
exit();
?>
