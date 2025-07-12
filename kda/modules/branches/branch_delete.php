<?php
session_start();
include('../config/db.php');

// Check ID passed
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-3'>Invalid Request!</div>";
    exit();
}

$id = $_GET['id'];

// Check if branch exists
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id = $id");
$branch = mysqli_fetch_assoc($result);

if (!$branch) {
    echo "<div class='alert alert-danger m-3'>Branch not found!</div>";
    exit();
}

// Delete query
mysqli_query($conn, "DELETE FROM branches WHERE id = $id");

// Redirect to branch list
header("Location: branch_list.php?msg=Branch Deleted Successfully");
exit();
?>
