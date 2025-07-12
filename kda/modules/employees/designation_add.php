<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// fetch all permissions
$permissions = $pdo->query("SELECT * FROM permissions ORDER BY permission_name ASC")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $status = $_POST['status'];
  $pdo->prepare("INSERT INTO designations (title, status) VALUES (?, ?)")->execute([$title, $status]);

  $designation_id = $pdo->lastInsertId();

  // assign selected permissions
  if (!empty($_POST['permissions'])) {
    foreach ($_POST['permissions'] as $pid) {
      $pdo->prepare("INSERT INTO designation_permissions (designation_id, permission_id) VALUES (?, ?)")->execute([$designation_id, $pid]);
    }
  }

  header("Location: designation_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Designation with Permissions</title>
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

    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-select">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Assign Permissions</label><br>
      <?php foreach($permissions as $p): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="permissions[]" value="<?= $p['id'] ?>" id="perm<?= $p['id'] ?>">
          <label class="form-check-label" for="perm<?= $p['id'] ?>">
            <?= $p['permission_name'] ?>
          </label>
        </div>
      <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-primary">Save Designation</button>
    <a href="designation_list.php" class="btn btn-secondary">← Back</a>
  </form>

</div>
</div>

</body>
</html>
