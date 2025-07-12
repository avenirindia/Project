<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// File uploads directory
$uploadDir = $_SERVER['DOCUMENT_ROOT']."/Project/kda/uploads/branches/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// File Upload Function
function uploadFile($field, $uploadDir) {
    if (!empty($_FILES[$field]['name'])) {
        $filename = time().'_'.$_FILES[$field]['name'];
        move_uploaded_file($_FILES[$field]['tmp_name'], $uploadDir.$filename);
        return $filename;
    }
    return null;
}

// Upload files
$aadhaar = uploadFile('aadhaar_card', $uploadDir);
$pan = uploadFile('pan_card', $uploadDir);
$bank = uploadFile('bank_passbook', $uploadDir);
$tax = uploadFile('tax_receipt', $uploadDir);
$agreement = uploadFile('agreement_copy', $uploadDir);
$police = uploadFile('police_letter', $uploadDir);

// Insert Query
$query = "INSERT INTO branches 
(branch_name, branch_code, ps, district, state, pin_code, latitude, longitude, opening_date, landlord_name, father_name, landlord_address, mobile_no, land_details, aadhaar_card, pan_card, bank_passbook, tax_receipt, agreement_copy, police_letter, rent_amount, rent_advance, unit_price, start_unit)
VALUES 
(
'".$_POST['branch_name']."',
'".$_POST['branch_code']."',
'".$_POST['ps']."',
'".$_POST['district']."',
'".$_POST['state']."',
'".$_POST['pin_code']."',
'".$_POST['latitude']."',
'".$_POST['longitude']."',
'".$_POST['opening_date']."',
'".$_POST['landlord_name']."',
'".$_POST['father_name']."',
'".$_POST['landlord_address']."',
'".$_POST['mobile_no']."',
'".$_POST['land_details']."',
'$aadhaar',
'$pan',
'$bank',
'$tax',
'$agreement',
'$police',
'".$_POST['rent_amount']."',
'".$_POST['rent_advance']."',
'".$_POST['unit_price']."',
'".$_POST['start_unit']."'
)";

if (mysqli_query($conn, $query)) {
    header("Location: branch_list.php?success=1");
} else {
    echo "<div class='alert alert-danger'>Error: ".mysqli_error($conn)."</div>";
}
?>
