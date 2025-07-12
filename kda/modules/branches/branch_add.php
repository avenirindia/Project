<?php
session_start();
include('../config/db.php');

// Auto Branch Code generate
$codeResult = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM branches");
$row = mysqli_fetch_assoc($codeResult);
$new_id = $row['max_id'] + 1;
$branch_code = "BR" . str_pad($new_id, 5, '0', STR_PAD_LEFT);
?>

<form action="branch_add_save.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">

  <h4 class="mb-3">➕ Add New Branch</h4>

  <div class="row mb-3">
    <div class="col-md-6">
      <label class="form-label">Branch Name</label>
      <input type="text" name="branch_name" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Branch Code</label>
      <input type="text" name="branch_code" value="<?php echo $branch_code; ?>" readonly class="form-control">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Branch Address</label>
    <textarea name="branch_address" class="form-control" rows="2" required></textarea>
  </div>

  <div class="row mb-3">
    <div class="col-md-4">
      <label class="form-label">Police Station (PS)</label>
      <input type="text" name="ps" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">District</label>
      <input type="text" name="district" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">State</label>
      <input type="text" name="state" class="form-control">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Pin Code</label>
    <input type="text" name="pin" class="form-control" pattern="\d{6}">
  </div>

  <div class="mb-3">
    <label class="form-label">Geo Location (Latitude, Longitude)</label>
    <input type="text" name="location" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Branch Opening Date</label>
    <input type="date" name="opening_date" class="form-control" required>
  </div>

  <h5 class="mt-4">🏠 Landlord Details</h5>

  <div class="row mb-3">
    <div class="col-md-6">
      <label class="form-label">Landlord Name</label>
      <input type="text" name="landlord_name" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Father's Name</label>
      <input type="text" name="father_name" class="form-control">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Landlord Address</label>
    <textarea name="landlord_address" class="form-control" rows="2"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Landlord Mobile No</label>
    <input type="text" name="landlord_mobile" class="form-control" pattern="\d{10}">
  </div>

  <div class="mb-3">
    <label class="form-label">Land Details</label>
    <textarea name="land_details" class="form-control" rows="2"></textarea>
  </div>

  <h5 class="mt-4">📝 Upload Documents</h5>

  <div class="row mb-3">
    <div class="col-md-4">
      <label class="form-label">Aadhaar Card</label>
      <input type="file" name="aadhaar" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">PAN Card</label>
      <input type="file" name="pan" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">Bank Passbook</label>
      <input type="file" name="passbook" class="form-control">
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-4">
      <label class="form-label">Tax Receipt</label>
      <input type="file" name="tax_receipt" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">Agreement Copy</label>
      <input type="file" name="agreement" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">Police Intimation Letter</label>
      <input type="file" name="police_letter" class="form-control">
    </div>
  </div>

  <h5 class="mt-4">💰 Rent & Utilities</h5>

  <div class="row mb-3">
    <div class="col-md-4">
      <label class="form-label">Rent Amount (₹)</label>
      <input type="number" name="rent_amount" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Rent Advance Amount (₹)</label>
      <input type="number" name="rent_advance" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">Rent Payment Date (1-31)</label>
      <input type="number" name="rent_payment_date" class="form-control" min="1" max="31" required>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-6">
      <label class="form-label">Electricity Unit Price (₹)</label>
      <input type="number" step="0.01" name="electricity_unit_price" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Starting Unit</label>
      <input type="number" name="start_unit" class="form-control">
    </div>
  </div>

  <div class="text-end">
    <button type="submit" class="btn btn-primary px-4">Save Branch</button>
  </div>

</form>
