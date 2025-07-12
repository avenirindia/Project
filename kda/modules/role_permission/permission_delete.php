<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-3'>Permission ID missing!</div>";
    exit();
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM permissions WHERE id=$id");

header("Location: permission_list.php");
exit();
?>
