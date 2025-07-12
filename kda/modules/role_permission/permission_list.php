<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$result = mysqli_query($conn, "SELECT * FROM permissions");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Permission List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
  <h3>🔐 Permission List</h3>
  <a href="permission_add.php" class="btn btn-success mb-3">➕ Add Permission</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Permission Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['permission_name'] ?></td>
        <td>
          <a href="permission_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">✏️ Edit</a>
          <a href="permission_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this permission?');" class="btn btn-danger btn-sm">🗑️ Delete</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
