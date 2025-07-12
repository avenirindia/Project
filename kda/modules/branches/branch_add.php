<?php
session_start();
include('../config/db.php');

// Session Validate
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check GET id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger m-3'>Invalid Request!</div>";
    exit();
}

$id = intval($_GET['id']);

// Fetch branch details
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id = $id");
$branch = mysqli_fetch_assoc($result);

if (!$branch) {
    echo "<div class='alert alert-danger m-3'>Branch not found!</div>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Branch Details - <?php echo htmlspecialchars($branch['branch_name']); ?></title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>

<div class="container my-4">
  <h4 class="mb-3">🏢 Branch Details</h4>

  <div class="card p-4 shadow-sm">

    <h5 class="text-primary">Branch Information</h5>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($branch['branch_name']); ?></p>
    <p><strong>Code:</strong> <?php echo htmlspecialchars($branch['branch_code']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($branch['branch_address']); ?>, PS: <?php echo htmlspecialchars($branch['ps']); ?>, <?php echo htmlspecialchars($branch['district']); ?>, <?php echo htmlspecialchars($branch['state']); ?>, <?php echo htmlspecialchars($branch['pin']); ?></p>
    <p><strong>Opening Date:</strong> <?php echo date("d-m-Y", strtotime($branch['branch_opening_date'])); ?></p>

    <hr>

    <h5 class="text-primary">Landlord Details</h5>
    <p><strong>Landlord:</strong> <?php echo htmlspecialchars($branch['landlord_name']); ?> (Father's: <?php echo htmlspecialchars($branch['father_name']); ?>)</p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($branch['landlord_address']); ?></p>
    <p><strong>Mobile:</strong> <?php echo htmlspecialchars($branch['landlord_mobile']); ?></p>
    <p><strong>Land Details:</strong> <?php echo htmlspecialchars($branch['land_details']); ?></p>

    <hr>

    <h5 class="text-primary">Rent & Utilities</h5>
    <p><strong>Rent Amount:</strong> ₹<?php echo number_format($branch['rent_amount']); ?></p>
    <p><strong>Advance:</strong> ₹<?php echo number_format($branch['rent_advance_amount']); ?></p>
    <p><strong>Rent Payment Date:</strong> <?php echo date("d-m-Y", strtotime($branch['rent_payment_date'])); ?></p>
    <p><strong>Electricity Unit Price:</strong> ₹<?php echo $branch['electricity_unit_price']; ?></p>
    <p><strong>Start Unit:</strong> <?php echo $branch['start_unit']; ?></p>

    <hr>

    <h5 class="text-primary">Uploaded Documents</h5>
    <ul>
      <?php if(!empty($branch['aadhaar_card'])): ?>
        <li><a href="../uploads/<?php echo $branch['aadhaar_card']; ?>" target="_blank">Aadhaar Card</a></li>
      <?php endif; ?>

      <?php if(!empty($branch['pan_card'])): ?>
        <li><a href="../uploads/<?php echo $branch['pan_card']; ?>" target="_blank">PAN Card</a></li>
      <?php endif; ?>

      <?php if(!empty($branch['bank_passbook'])): ?>
        <li><a href="../uploads/<?php echo $branch['bank_passbook']; ?>" target="_blank">Bank Passbook</a></li>
      <?php endif; ?>

      <?php if(!empty($branch['tax_receipt'])): ?>
        <li><a href="../uploads/<?php echo $branch['tax_receipt']; ?>" target="_blank">Tax Receipt</a></li>
      <?php endif; ?>

      <?php if(!empty($branch['agreement_copy'])): ?>
        <li><a href="../uploads/<?php echo $branch['agreement_copy']; ?>" target="_blank">Agreement Copy</a></li>
      <?php endif; ?>

      <?php if(!empty($branch['police_letter'])): ?>
        <li><a href="../uploads/<?php echo $branch['police_letter']; ?>" target="_blank">Police Intimation Letter</a></li>
      <?php endif; ?>
    </ul>

    <div class="text-end">
      <a href="branch_list.php" class="btn btn-secondary">⬅️ Back to List</a>
    </div>

  </div>
</div>

</body>
</html>
<div class="text-end mt-4">
  <a href="branch_edit.php?id=<?php echo $branch['id']; ?>" class="btn btn-primary me-2">✏️ Edit</a>

  <a href="branch_delete.php?id=<?php echo $branch['id']; ?>" class="btn btn-danger me-2"
     onclick="return confirm('Are you sure you want to delete this branch? This action cannot be undone.');">
     🗑️ Delete
  </a>

  <a href="branch_pdf.php?id=<?php echo $branch['id']; ?>" class="btn btn-success">
    📄 Download PDF
  </a>
</div>
    <div class="text-end mt-4">
      <a href="branch_edit.php?id=<?php echo $branch['id']; ?>" class="btn btn-primary me-2">✏️ Edit</a>

      <a href="branch_delete.php?id=<?php echo $branch['id']; ?>" class="btn btn-danger me-2"
         onclick="return confirm('Are you sure you want to delete this branch? This action cannot be undone.');">
         🗑️ Delete
      </a>

      <a href="branch_pdf.php?id=<?php echo $branch['id']; ?>" class="btn btn-success">
        📄 Download PDF
      </a>

      <a href="branch_list.php" class="btn btn-secondary ms-2">⬅️ Back to List</a>
    </div>
