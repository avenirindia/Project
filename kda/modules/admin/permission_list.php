<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$stmt = $pdo->query("SELECT * FROM permissions ORDER BY id DESC");
$permissions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Permission List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="mb-3">📋 Permission List</h4>
    <a href="permission_add.php" class="btn btn-success mb-3">+ Add Permission</a>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Permission Name</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($permissions as $p): ?>
        <tr>
          <td><?php echo $p['id']; ?></td>
          <td><?php echo $p['permission_name']; ?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>

  </div>
</div>

</body>
</html>
