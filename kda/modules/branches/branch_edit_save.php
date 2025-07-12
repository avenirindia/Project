<?php
session_start();
include('../config/db.php');

$id               = $_POST['id'];
$branch_name      = $_POST['branch_name'];
$branch_address   = $_POST['branch_address'];
$district         = $_POST['district'];
$state            = $_POST['state'];
$pin              = $_POST['pin'];
$rent_amount      = $_POST['rent_amount'];
$rent_payment_date= $_POST['rent_payment_date'];

$query = "UPDATE branches SET 
          branch_name = '$branch_name',
          branch_address = '$branch_address',
          district = '$district',
          state = '$state',
          pin = '$pin',
          rent_amount = '$rent_amount',
          rent_payment_date = '$rent_payment_date'
          WHERE id = $id";

if (mysqli_query($conn, $query)) {
    header("Location: branch_list.php?msg=Branch Updated Successfully");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
