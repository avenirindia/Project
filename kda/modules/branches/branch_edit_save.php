<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// ID check
if(!isset($_POST['id'])) {
    echo "<div class='alert alert-danger'>Invalid Request!</div>";
    exit();
}

$id = $_POST['id'];

// All form data fetch
$branch_name = $_POST['branch_name'];
$ps = $_POST['ps'];
$district = $_POST['district'];
$state = $_POST['state'];
$pin = $_POST['pin'];
$location = $_POST['location'];
$opening_date = $_POST['opening_date'];
$landlord_name = $_POST['landlord_name'];
$father_name = $_POST['father_name'];
$landlord_address = $_POST['landlord_address'];
$landlord_mobile = $_POST['landlord_mobile'];
$land_details = $_POST['land_details'];
$rent_amount = $_POST['rent_amount'];
$rent_advance = $_POST['rent_advance'];
$rent_payment_date = $_POST['rent_payment_date'];
$electricity_unit_price = $_POST['electricity_unit_price'];
$start_unit = $_POST['start_unit'];

// Update query
$query = "UPDATE branches SET 
    branch_name='$branch_name',
    ps='$ps',
    district='$district',
    state='$state',
    pin='$pin',
    location='$location',
    opening_date='$opening_date',
    landlord_name='$landlord_name',
    father_name='$father_name',
    landlord_address='$landlord_address',
    landlord_mobile='$landlord_mobile',
    land_details='$land_details',
    rent_amount='$rent_amount',
    rent_advance='$rent_advance',
    rent_payment_date='$rent_payment_date',
    electricity_unit_price='$electricity_unit_price',
    start_unit='$start_unit'
    WHERE id=$id";

if(mysqli_query($conn, $query)) {
    header("Location: branch_list.php?success=1");
    exit();
} else {
    echo "<div class='alert alert-danger'>Failed to update branch!</div>";
}
?>
