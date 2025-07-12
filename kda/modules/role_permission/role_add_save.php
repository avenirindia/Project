<?php
include('../../config/db.php');

$designation_name = mysqli_real_escape_string($conn, $_POST['designation_name']);

// Check for duplicate
$check = mysqli_query($conn, "SELECT * FROM designations WHERE designation_name='$designation_name'");
if(mysqli_num_rows($check) > 0){
  header("Location: role_add.php?msg=Designation Already Exists");
  exit;
}

// Save new designation
mysqli_query($conn, "INSERT INTO designations (designation_name) VALUES ('$designation_name')");

header("Location: role_list.php?msg=New Designation Added Successfully");
?>
