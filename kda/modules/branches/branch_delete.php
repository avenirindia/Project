<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Check if branch ID exists
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-3'>Invalid Branch Delete Request!</div>";
    exit();
}

$id = $_GET['id'];

// Confirm branch exists before delete
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id = $id");
$branch = mysqli_fetch_assoc($result);

if (!$branch) {
    echo "<div class='alert alert-danger m-3'>Branch not found!</div>";
    exit();
}

// Delete branch query
$delete = mysqli_query($conn, "DELETE FROM branches WHERE id = $id");

if ($delete) {
    // Optional: unlink documents from uploads folder if needed
    // unlink("../../uploads/".$branch['aadhaar_copy']);
    // unlink("../../uploads/".$branch['pan_copy']);
    // unlink("../../uploads/".$branch['bank_passbook']);
    // unlink("../../uploads/".$branch['tax_receipt']);
    // unlink("../../uploads/".$branch['agreement_copy']);
    // unlink("../../uploads/".$branch['police_intimation']);

    header("Location: branch_list.php?deleted=1");
    exit();
} else {
    echo "<div class='alert alert-danger m-3'>Failed to delete branch. Try again!</div>";
}
?>
