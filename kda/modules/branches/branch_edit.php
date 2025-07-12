<?php
session_start();
include('../config/db.php');

// Check ID passed
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
  <h4 class="mb-3">✏️ Edit Branch</h4>

  <form action="branch_edit_save.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">

    <input type="hidden" name="id" value="<?php echo $branch['id']; ?>">

    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Branch Name</label>
        <input type="text" name="branch_name" class="form-control" value="<?php echo $branch['branch_name']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Branch Code</label>
        <input type="text" name="branch_code" class="form-control" value="<?php echo $branch['branch_code']; ?>" readonly>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Branch Address</label>
      <textarea name="branch_address" class="form-control" rows="2"><?php echo $branch['branch_address']; ?></textarea>
    </div>

    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">District</label>
        <input type="text" name="district" class="form-control" value="<?php echo $branch['district']; ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">State</label>
        <input type="text" name="state" class="form-control" value="<?php echo $branch['state']; ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Pin Code</label>
        <input type="text" name="pin" class="form-control" value="<?php echo $branch['pin']; ?>">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Rent Amount (₹)</label>
        <input type="number" name="rent_amount" class="form-control" value="<?php echo $branch['rent_amount']; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Rent Payment Date (1-31)</label>
        <input type="number" name="rent_payment_date" class="form-control" value="<?php echo $branch['rent_payment_date']; ?>" min="1" max="31">
      </div>
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-primary px-4">Update Branch</button>
      <a href="branch_list.php" class="btn btn-secondary">Cancel</a>
    </div>

  </form>
</div>
