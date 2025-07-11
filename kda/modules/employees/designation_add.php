<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];

  $stmt = $pdo->prepare("INSERT INTO designations (title) VALUES (?)");
  $stmt->execute([$title]);

  header("Location: designation_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Designation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="mb-3">➕ Add New Designation</h4>

    <form method="POST">
      <div class="mb-3">
        <label>Designation Title</label>
        <input type="text" name="title" required class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="designation_list.php" class="btn btn-secondary">← Back</a>
    </form>
  </div>
</div>

</body>
</html>
