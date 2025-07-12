<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation_name = trim($_POST['designation_name']);

    if (empty($designation_name)) {
        die("<div class='alert alert-danger m-3'>Designation Name is required.</div>");
    }

    // Use Prepared Statement
    $stmt = $conn->prepare("INSERT INTO designations (designation_name) VALUES (?)");
    $stmt->bind_param("s", $designation_name);

    if ($stmt->execute()) {
        header("Location: role_list.php");
        exit();
    } else {
        echo "<div class='alert alert-danger m-3'>Error: " . $conn->error . "</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-warning m-3'>Invalid Request.</div>";
}
?>
