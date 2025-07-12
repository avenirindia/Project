<?php
include '../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Auto Branch Code
$branch_code = "BR" . rand(1000, 9999);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $branch_name = $_POST['branch_name'];
  $address = $_POST['address'];
  $ps = $_POST['ps'];
  $district = $_POST['district'];
  $state = $_POST['state'];
  $pin_code = $_POST['pin_code'];
  $location = $_POST['location'];
  $opening_date = $_POST['opening_date'];
  $landlord_name = $_POST['landlord_name'];
  $landlord_father_name = $_POST['landlord_father_name'];
  $landlord_address = $_POST['landlord_address'];
  $landlord_mobile = $_POST['landlord_mobile'];
  $land_details = $_POST['land_details'];
  $rent_amount = $_POST['rent_amount'];
  $rent_advance = $_POST['rent_advance'];
  $electricity_unit_price = $_POST['electricity_unit_price'];
  $start_unit = $_POST['start_unit'];

  // File uploads
  $aadhaar_doc = 'uploads/' . $_FILES['aadhaar_doc']['name'];
  move_uploaded_file($_FILES['aadhaar_doc']['tmp_name'], '../../' . $aadhaar_doc);

  $pan_doc = 'uploads/' . $_FILES['pan_doc']['name'];
  move_uploaded_file($_FILES['pan_doc']['tmp_name'], '../../' . $pan_doc);

  $bank_passbook = 'uploads/' . $_FILES['bank_passbook']['name'];
  move_uploaded_file($_FILES['bank_passbook']['tmp_name'], '../../' . $bank_passbook);

  $tax_receipt = 'uploads/' . $_FILES['tax_receipt']['name'];
  move_uploaded_file($_FILES['tax_receipt']['tmp_name'], '../../' . $tax_receipt);

  $agreement_copy = 'uploads/' . $_FILES['agreement_copy']['name'];
  move_uploaded_file($_FILES['agreement_copy']['tmp_name'], '../../' . $agreement_copy);

  $police_letter = 'uploads/' . $_FILES['police_letter']['name'];
  move_uploaded_file($_FILES['police_letter']['tmp_name'], '../../' . $police_letter);

  // Insert Query
  $stmt = $pdo->prepare("INSERT INTO branches (branch_code, branch_name, address, ps, district, state, pin_code, location, opening_date, landlord_name, landlord_father_name, landlord_address, landlord_mobile, land_details, aadhaar_doc, pan_doc, bank_passbook, tax_receipt, agreement_copy, police_letter, rent_amount, rent_advance, electricity_unit_price, start_unit)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt->execute([$branch_code, $branch_name, $address, $ps, $district, $state, $pin_code, $location, $opening_date, $landlord_name, $landlord_father_name, $landlord_address, $landlord_mobile, $land_details, $aadhaar_doc, $pan_doc, $bank_passbook, $tax_receipt, $agreement_copy, $police_letter, $rent_amount, $rent_advance, $electricity_unit_price, $start_unit]);

  header("Location: branch_list.php");
  exit;
}
?>
