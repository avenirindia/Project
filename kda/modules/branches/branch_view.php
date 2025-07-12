<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-3'>Invalid Branch ID!</div>";
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id=$id");
$branch = mysqli_fetch_assoc($result);

if (!$branch) {
    echo "<div class='alert alert-danger m-3'>Branch not found!</div>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Branch Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white rounded shadow p-4">
    <h4 class="mb-3">📍 Branch Details: <?= $branch['branch_name'] ?> (<?= $branch['branch_code'] ?>)</h4>
    
    <table class="table table-bordered">
        <tr><th>Branch Name</th><td><?= $branch['branch_name'] ?></td></tr>
        <tr><th>Code</th><td><?= $branch['branch_code'] ?></td></tr>
        <tr><th>Address</th><td><?= $branch['ps'] ?>, <?= $branch['district'] ?>, <?= $branch['state'] ?> - <?= $branch['pin'] ?></td></tr>
        <tr><th>Location (Geo)</th><td><?= $branch['location'] ?></td></tr>
        <tr><th>Opening Date</th><td><?= $branch['opening_date'] ?></td></tr>
        <tr><th>Landlord Name</th><td><?= $branch['landlord_name'] ?></td></tr>
        <tr><th>Father's Name</th><td><?= $branch['father_name'] ?></td></tr>
        <tr><th>Landlord Address</th><td><?= $branch['landlord_address'] ?></td></tr>
        <tr><th>Mobile</th><td><?= $branch['landlord_mobile'] ?></td></tr>
        <tr><th>Land Details</th><td><?= $branch['land_details'] ?></td></tr>
        <tr><th>Rent Amount</th><td>₹ <?= $branch['rent_amount'] ?></td></tr>
        <tr><th>Advance</th><td>₹ <?= $branch['rent_advance'] ?></td></tr>
        <tr><th>Rent Payment Date</th><td><?= $branch['rent_payment_date'] ?> তারিখ</td></tr>
        <tr><th>Electricity Unit Price</th><td>₹ <?= $branch['electricity_unit_price'] ?></td></tr>
        <tr><th>Start Unit</th><td><?= $branch['start_unit'] ?></td></tr>
        <tr><th>Aadhaar</th><td><a href="../../uploads/branches/<?= $branch['aadhar_card'] ?>" target="_blank">View</a></td></tr>
        <tr><th>PAN</th><td><a href="../../uploads/branches/<?= $branch['pan_card'] ?>" target="_blank">View</a></td></tr>
        <tr><th>Bank Passbook</th><td><a href="../../uploads/branches/<?= $branch['bank_passbook'] ?>" target="_blank">View</a></td></tr>
        <tr><th>Tax Receipt</th><td><a href="../../uploads/branches/<?= $branch['tax_receipt'] ?>" target="_blank">View</a></td></tr>
        <tr><th>Agreement</th><td><a href="../../uploads/branches/<?= $branch['agreement_copy'] ?>" target="_blank">View</a></td></tr>
        <tr><th>Police Intimation</th><td><a href="../../uploads/branches/<?= $branch['police_letter'] ?>" target="_blank">View</a></td></tr>
    </table>

    <a href="branch_list.php" class="btn btn-secondary mt-2">🔙 Back to List</a>
</div>

</body>
</html>
