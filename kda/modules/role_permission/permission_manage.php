<?php
include('../../config/constants.php');   // এড করব প্রথম লাইনে
include(BASE_PATH . '/config/db_connect.php');
include(BASE_PATH . '/includes/header.php');

if(!isset($_GET['id'])){
  die("No Designation ID provided.");
}
$designation_id = $_GET['id'];

$permissions = mysqli_query($conn, "SELECT * FROM permissions");
$assigned_permissions = mysqli_query($conn, "SELECT permission_id FROM role_permissions WHERE designation_id='$designation_id'");

$assigned = [];
while($row = mysqli_fetch_assoc($assigned_permissions)) {
  $assigned[] = $row['permission_id'];
}
?>
