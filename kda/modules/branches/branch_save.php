<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Auto Branch Code Generation
$monthYear = date('Ym'); // 202507
$lastBranch = mysqli_query($conn, "SELECT MAX(id) AS last_id FROM branches");
$lastRow = mysqli_fetch_assoc($lastBranch);
$nextNumber = $lastRow['last_id'] ? $lastRow['last_id'] + 100 : 100;
$branch_code = "BR-".$monthYear."/".$nextNumber;

// Form Data Fetch
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

// Document Upload Handling
$upload_dir = "../../uploads/branches/";
$aadhar_file = $_FILES['aadhar_card']['name'];
$pan_file = $_FILES['pan_card']['name'];
$bank_file = $_FILES['bank_passbook']['name'];
$tax_file = $_FILES['tax_receipt']['name'];
$agreement_file = $_FILES['agreement_copy']['name'];
$police_file = $_FILES['police_letter']['name'];

move_uploaded_file($_FILES['aadhar_card']['tmp_name'], $upload_dir.$aadhar_file);
move_uploaded_file($_FILES['pan_card']['tmp_name'], $upload_dir.$pan_file);
move_uploaded_file($_FILES['bank_passbook']['tmp_name'], $upload_dir.$bank_file);
move_uploaded_file($_FILES['tax_receipt']['tmp_name'], $upload_dir.$tax_file);
move_uploaded_file($_FILES['agreement_copy']['tmp_name'], $upload_dir.$agreement_file);
move_uploaded_file($_FILES['police_letter']['tmp_name'], $upload_dir.$police_file);

// Insert Query
$query = "INSERT INTO branches 
(branch_code, branch_name, ps, district, state, pin, location, opening_date, landlord_name, father_name, landlord_address, landlord_mobile, land_details, rent_amount, rent_advance, rent_payment_date, electricity_unit_price, start_unit, aadhar_card, pan_card, bank_passbook, tax_receipt, agreement_copy, police_letter) 
VALUES 
('$branch_code', '$branch_name', '$ps', '$district', '$state', '$pin', '$location', '$opening_date', '$landlord_name', '$father_name', '$landlord_address', '$landlord_mobile', '$land_details', '$rent_amount', '$rent_advance', '$rent_payment_date', '$electricity_unit_price', '$start_unit', '$aadhar_file', '$pan_file', '$bank_file', '$tax_file', '$agreement_file', '$police_file')";

if(mysqli_query($conn, $query)) {
    header("Location: branch_list.php?success=1");
    exit();
} else {
    echo "<div class='alert alert-danger'>Failed to save branch!</div>";
}
?>
