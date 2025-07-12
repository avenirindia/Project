<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $branch_code = "BR" . rand(1000, 9999);
  $branch_name = $_POST['branch_name'];
  $address = $_POST['address'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];

  $stmt = $pdo->prepare("INSERT INTO branches (branch_code, branch_name, address, mobile, email) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$branch_code, $branch_name, $address, $mobile, $email]);

  header("Location: branch_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Branch</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="mb-3">🏢 Add New Branch</h4>

    <form method="POST">
      <div class="mb-3">
        <label>Branch Name</label>
        <input type="text" name="branch_name" required class="form-control">
      </div>
      <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="2"></textarea>
      </div>
      <div class="mb-3">
        <label>Mobile</label>
        <input type="text" name="mobile" class="form-control">
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">➕ Add Branch</button>
      <a href="branch_list.php" class="btn btn-secondary">← Back</a>
    </form>

  </div>
</div>

</body>
</html>
