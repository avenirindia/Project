<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');

// Validate required fields
if(empty($_POST['branch_name']) || empty($_POST['branch_code'])){
  die("Branch Name and Branch Code are required.");
}

// Collect data
$branch_name            = mysqli_real_escape_string($conn, $_POST['branch_name']);
$branch_code            = mysqli_real_escape_string($conn, $_POST['branch_code']);
$branch_address         = mysqli_real_escape_string($conn, $_POST['branch_address']);
$district               = mysqli_real_escape_string($conn, $_POST['district']);
$state                  = mysqli_real_escape_string($conn, $_POST['state']);
$pin_code               = mysqli_real_escape_string($conn, $_POST['pin_code']);
$location               = mysqli_real_escape_string($conn, $_POST['location']);
$opening_date           = mysqli_real_escape_string($conn, $_POST['opening_date']);
$landlord_name          = mysqli_real_escape_string($conn, $_POST['landlord_name']);
$landlord_father_name   = mysqli_real_escape_string($conn, $_POST['landlord_father_name']);
$landlord_address       = mysqli_real_escape_string($conn, $_POST['landlord_address']);
$landlord_mobile        = mysqli_real_escape_string($conn, $_POST['landlord_mobile']);
$land_details           = mysqli_real_escape_string($conn, $_POST['land_details']);
$rent_amount            = mysqli_real_escape_string($conn, $_POST['rent_amount']);
$rent_advance           = mysqli_real_escape_string($conn, $_POST['rent_advance']);
$electricity_unit_price = mysqli_real_escape_string($conn, $_POST['electricity_unit_price']);
$start_unit             = mysqli_real_escape_string($conn, $_POST['start_unit']);

// Optional: Handle file uploads if any (example for Aadhaar copy)
$aadhaar_copy = "";
if(isset($_FILES['aadhaar_copy']) && $_FILES['aadhaar_copy']['error'] == 0){
  $target_dir = BASE_PATH . "/uploads/branch_documents/";
  if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);
  $filename = time().'_'.basename($_FILES["aadhaar_copy"]["name"]);
  $target_file = $target_dir . $filename;
  move_uploaded_file($_FILES["aadhaar_copy"]["tmp_name"], $target_file);
  $aadhaar_copy = $filename;
}

// Insert into database
$query = "INSERT INTO branches 
(branch_name, branch_code, branch_address, district, state, pin_code, location, opening_date, landlord_name, landlord_father_name, landlord_address, landlord_mobile, land_details, rent_amount, rent_advance, electricity_unit_price, start_unit, aadhaar_copy)
VALUES
('$branch_name', '$branch_code', '$branch_address', '$district', '$state', '$pin_code', '$location', '$opening_date', '$landlord_name', '$landlord_father_name', '$landlord_address', '$landlord_mobile', '$land_details', '$rent_amount', '$rent_advance', '$electricity_unit_price', '$start_unit', '$aadhaar_copy')";

mysqli_query($conn, $query) or die("Branch Save Failed: " . mysqli_error($conn));

// Redirect
header("Location: branch_list.php?msg=Branch added successfully");
exit;
?>
