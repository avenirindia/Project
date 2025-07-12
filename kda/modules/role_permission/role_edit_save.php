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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation_name = $_POST['designation_name'];

    if (empty($designation_name)) {
        die("Designation Name is required.");
    }

    $query = "UPDATE designations SET designation_name='$designation_name' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: role_list.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request.";
}
?>
