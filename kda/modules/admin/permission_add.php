<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $permission_name = $_POST['permission_name'];

  $stmt = $pdo->prepare("INSERT INTO permissions (permission_name) VALUES (?)");
  $stmt->execute([$permission_name]);

  header("Location: permission_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Permission</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="mb-3">➕ Add New Permission</h4>

    <form method="POST">
      <div class="mb-3">
        <label>Permission Name</label>
        <input type="text" name="permission_name" required class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Save</button>
      <a href="permission_list.php" class="btn btn-secondary">← Back</a>
    </form>
  </div>
</div>

</body>
</html>
