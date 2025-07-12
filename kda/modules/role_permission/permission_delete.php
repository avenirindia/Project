<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM permissions WHERE id=$id");
header("Location: permission_list.php");
exit();
?>
