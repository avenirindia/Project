<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Auto Employee Code
$stmt = $pdo->query("SELECT MAX(id) AS last_id FROM employees");
$row = $stmt->fetch();
$next_id = $row['last_id'] + 1;
$employee_code = "EMP" . str_pad($next_id, 5, "0", STR_PAD_LEFT);

// Random Branch Code
$branch_code = rand(100000, 999999);
?>

</div>

<!DOCTYPE html>
<html>
<head>
  <title>Employee Application Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow p-4 mb-4">
  <h4 class="mb-3">📝 Employee Application</h4>

  <form method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
      <div class="col-md-4">
        <label>Employee Code</label>
        <input type="text" name="employee_code" readonly value="<?php echo $employee_code; ?>" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Branch Code</label>
        <input type="text" name="branch_code" readonly value="<?php echo $branch_code; ?>" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Employee Name</label>
        <input type="text" name="name" required class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label>Father's Name</label>
        <input type="text" name="father_name" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Date of Birth</label>
        <input type="date" name="dob" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Gender</label>
        <select name="gender" class="form-select">
          <option value="">--Select--</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
    </div>
<div class="row mb-3">
  <div class="col-md-6">
    <label>Present Address</label>
    <textarea name="present_address" class="form-control" rows="2"></textarea>
  </div>
  <div class="col-md-6">
    <label>Permanent Address</label>
    <textarea name="permanent_address" class="form-control" rows="2"></textarea>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label>Qualification</label>
    <input type="text" name="qualification" class="form-control">
  </div>
  <div class="col-md-6">
    
    <label>Designation</label>
    <select name="designation" class="form-select" required>
      <option value="">-- Select Designation --</option>
      <?php foreach($designations as $d): ?>
        <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
      <?php endforeach ?>
    </select>
  </div>
</div>

<div class="mb-3">
  <label>Joining Date</label>
  <input type="date" name="joining_date" class="form-control">
</div>
<div class="row mb-3">
  <div class="col-md-3">
    <label>Upload Passport Photo</label>
    <input type="file" name="photo" class="form-control">
  </div>
  <div class="col-md-3">
    <label>Upload Aadhaar Card</label>
    <input type="file" name="aadhaar_doc" class="form-control">
  </div>
  <div class="col-md-3">
    <label>Upload PAN Card</label>
    <input type="file" name="pan_doc" class="form-control">
  </div>
  <div class="col-md-3">
    <label>Upload Qualification Certificate</label>
    <input type="file" name="qualification_doc" class="form-control">
  </div>
</div>
<div class="row mb-3">
  <div class="col-md-3">
    <label>Bank Pass Book</label>
    <input type="file" name="bank_pass_book" class="form-control">
  </div>
  <div class="col-md-3">
    <label>Voter Card</label>
    <input type="file" name="voter_card" class="form-control">
  </div>
  <div class="col-md-3">
    <label>Application Form</label>
    <input type="file" name="application_form" class="form-control">
  </div>
  <div class="col-md-3">
    <label>Confirmation Letter</label>
    <input type="file" name="confirmation_letter" class="form-control">
  </div>
</div>
<div class="mb-3">
  <label><strong>Net Salary (Auto Calculated)</strong></label>
  <input type="number" name="net_salary" step="0.01" class="form-control" readonly>
</div>

<div class="d-flex gap-2">
  <button type="submit" class="btn btn-primary">➕ Submit Employee</button>
  <a href="employee_list.php" class="btn btn-secondary">← Back</a>
</div>
</form>
</div>
</div>

</body>
</html>
