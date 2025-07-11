<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$stmt = $pdo->query("SELECT * FROM designations ORDER BY id DESC");
$designations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Designation List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="mb-3">📋 Designation List</h4>
    <a href="designation_add.php" class="btn btn-success mb-3">+ Add New</a>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($designations as $d): ?>
        <tr>
          <td><?php echo $d['id']; ?></td>
          <td><?php echo $d['title']; ?></td>
          <td><?php echo $d['status']==1 ? 'Active' : 'Inactive'; ?></td>
          <td>
            <a href="designation_edit.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
            <a href="designation_delete.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Delete this?');" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>

  </div>
</div>

</body>
</html>
