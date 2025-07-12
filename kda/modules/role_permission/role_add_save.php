<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation_name = $_POST['designation_name'];

    if (empty($designation_name)) {
        die("Designation Name is required.");
    }

    $query = "INSERT INTO designations (designation_name) VALUES ('$designation_name')";
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
