<?php
session_start();
include('../config/db.php');

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-3'>Invalid Request!</div>";
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id = $id");
$branch = mysqli_fetch_assoc($result);

if (!$branch) {
    echo "<div class='alert alert-danger m-3'>Branch not found!</div>";
    exit();
}
?>

<div class="container my-4">
  <h4 class="mb-3">🏢 Branch Details</h4>

  <div class="card p-4 shadow-sm">

    <h5 class="text-primary">Branch Information</h5>
    <p><strong>Name:</strong> <?php echo $branch['branch_name']; ?></p>
    <p><strong>Code:</strong> <?php echo $branch['branch_code']; ?></p>
    <p><strong>Address:</strong> <?php echo $branch['branch_address']; ?>, PS: <?php echo $branch['ps']; ?>, <?php echo $branch['district']; ?>, <?php echo $branch['state']; ?>, <?php echo $branch['pin']; ?></p>
    <p><strong>Opening Date:</strong> <?php echo $branch['branch_opening_date']; ?></p>

    <hr>

    <h5 class="text-primary">Landlord Details</h5>
    <p><strong>Landlord:</strong> <?php echo $branch['landlord_name']; ?> (Father's: <?php echo $branch['father_name']; ?>)</p>
    <p><strong>Address:</strong> <?php echo $branch['landlord_address']; ?></p>
    <p><strong>Mobile:</strong> <?php echo $branch['landlord_mobile']; ?></p>
    <p><strong>Land Details:</strong> <?php echo $branch['land_details']; ?></p>

    <hr>

    <h5 class="text-primary">Rent & Utilities</h5>
    <p><strong>Rent Amount:</strong> ₹<?php echo $branch['rent_amount']; ?></p>
    <p><strong>Advance:</strong> ₹<?php echo $branch['rent_advance_amount']; ?></p>
    <p><strong>Rent Payment Date:</strong> <?php echo $branch['rent_payment_date']; ?></p>
    <p><strong>Electricity Unit Price:</strong> ₹<?php echo $branch['electricity_unit_price']; ?></p>
    <p><strong>Start Unit:</strong> <?php echo $branch['start_unit']; ?></p>

    <hr>

    <h5 class="text-primary">Uploaded Documents</h5>
    <ul>
      <li><a href="../uploads/<?php echo $branch['aadhaar_card']; ?>" target="_blank">Aadhaar Card</a></li>
      <li><a href="../uploads/<?php echo $branch['pan_card']; ?>" target="_blank">PAN Card</a></li>
      <li><a href="../uploads/<?php echo $branch['bank_passbook']; ?>" target="_blank">Bank Passbook</a></li>
      <li><a href="../uploads/<?php echo $branch['tax_receipt']; ?>" target="_blank">Tax Receipt</a></li>
      <li><a href="../uploads/<?php echo $branch['agreement_copy']; ?>" target="_blank">Agreement Copy</a></li>
      <li><a href="../uploads/<?php echo $branch['police_letter']; ?>" target="_blank">Police Intimation Letter</a></li>
    </ul>

    <div class="text-end">
      <a href="branch_list.php" class="btn btn-secondary">⬅️ Back to List</a>
    </div>

  </div>
</div>
